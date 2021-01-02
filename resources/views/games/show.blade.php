@extends('layouts.app')

@section('title',$game->name)

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    @if($game->image !=null)
    <img src={{"http://reviewer.test/" . $game->image->path}} width ="40" height ="40">
    @elseif($game->user_id == Auth::id())
    <form method="POST" enctype="multipart/form-data" id="upload-image" action="{{route('images.store.game',['game'=>$game])}}" >
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <input type="file" name="image" placeholder="Upload Image" id="image">
                @error('image')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
                </div>
            </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary" id="submit">Submit</button>
            </div>
        </div>     
    </form>
    @endif
    <p>name: {{$game->name}}</p>
    <p>release date: {{$game->release_date ?? 'unknown'}}</p>
    <p>publisher: {{$game->publisher}}</p>
    <p>developer: {{$game->developer}}</p>
    <p>posted by: {{$game->user->name}}
    @if($game->user_id == Auth::id())
        <a href="{{route('games.edit',['game' => $game])}}">Edit Game</a>
        <form action="{{route('games.destroy',['id' => $game->id])}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    @endif

    
    <div id="root">
        @if(!($game->user_id == Auth::id()))
            <h3>Post review</h3>
            Title: <input type="text" id="titInput" v-model="newReviewTitle">
            Description: <input type="text" id="descInput" v-model="newReviewDesc" size ="30">
            Rating: <input type="number" id="ratingInput" v-model="newReviewRating" min="1" max="10">
            <button @click="createReview">Post/Edit review</button>
        @endif
        <ul>
            <li v-for="review in reviews">
                <h4>@{{review.title}}</h4>
                <p>@{{review.description}}</p>
                <p>Posted by: @{{review.username}}  Rating: @{{review.rating}}</p> 
                
                
            </li>
        </ul>
    </div>


    <script>
        var app = new Vue({
            el:"#root",
            data: {
                reviews: [],
                newReviewTitle: '',
                newReviewDesc: '',
                newReviewRating: 1
            },
            //will get the reviews from a get route
            mounted() {
                //passes the API the game so will only show reviews for this game
                axios.get("{{route('api.reviews.index')}}")
                .then(response => {
                    //Show only the reviews for the current
                    const data = response.data;
                    this.reviews = data.filter(review => review.game_id == <?php Print($game->id); ?>);
                })
                .catch(response => {
                    console.log(response);
                })
            },
            methods: {
                createReview: function(){
                    //Gets current user who is posting comment
                    const userID = <?php Print(Auth::id()); ?>;
                    axios.post("{{route('api.reviews.store',['game'=>$game])}}", {
                        title: this.newReviewTitle,
                        description: this.newReviewDesc,
                        rating: this.newReviewRating,
                        user: userID
                    })
                    .then(response => {
                        if(response.data.updated){
                            const index = this.reviews.findIndex(review => review.user_id == userID);
                            this.reviews[index] = response.data;
                        } else {
                            this.reviews.push(response.data);
                        }
                        this.newReviewTitle = '';
                        this.newReviewDesc ='';
                        this.newReviewRating = 1;
                    })
                    .catch(response => {
                        console.log(response);
                    })
                }
            },
        });
    </script>
@endsection
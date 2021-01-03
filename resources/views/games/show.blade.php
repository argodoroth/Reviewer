@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endsection

@section('title',$game->name)

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    
    <div id="mainItem" class="card" style="width: 60rem;">
        @if($game->image != null)
        <img class="card-img-top" src={{"http://reviewer.test/" . $game->image->path}} width="100" height="100">
        @elseif($game->user_id == Auth::id())
            <p>Upload Game image:</p> 
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
        <div class="card-body">
            <h2 class="card-title"><b>{{$game->name}}</b></h2>
            <p class="card-text"><b>Posted by: {{$game->user->name}}</b></p>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Publisher: {{$game->publisher}}</li>
            <li class="list-group-item">Developer: {{$game->developer}}</li>
            <li class="list-group-item">player count: {{$game->players->count()}}</li>
        </ul>
        <div class="card-body">
        @if($game->user_id == Auth::id())
            <a href="{{route('games.edit',['game' => $game])}}" class="card-link">Edit Game</a>
            <a href="{{route('games.destroy',['id' => $game->id])}}"
                        onclick="event.preventDefault();
                                        document.getElementById('delete-form').submit();">
                        {{ __('delete game') }}
                </a>
                <form id="delete-form" action="{{route('games.destroy',['id' => $game->id])}}" method="POST" class="d-none">
                    @csrf
                    @method('DELETE')
                </form>
        @endif
        </div>
    </div>
    
    <div id="root">
        @if(!($game->user_id == Auth::id()))
            <div id="input" style = "align-content: center; margin: auto; text-align: center;">
                <h3>Post review</h3>
                Title: <input type="text" id="titInput" v-model="newReviewTitle">
                Description: <input type="text" id="descInput" v-model="newReviewDesc" size ="30">
                Rating: <input type="number" id="ratingInput" v-model="newReviewRating" min="1" max="10">
                <button @click="createReview">Post/Edit review</button>
            </div>
        @endif
        <ul>
            <li v-for="review in reviews" style = "list-style-type: none;">
                <div id="mainItem" class="card" style="width: 40rem; ">
                    <div class="card-body">
                        <h4 class="card-title"><b>@{{review.title}}</b></h4>
                        <p class="card-text"><b>Posted by: @{{review.username}}</b></p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">@{{review.description}}</li>
                        <li class="list-group-item">Rating: @{{review.rating}}</li>
                    </ul>
                </div>
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
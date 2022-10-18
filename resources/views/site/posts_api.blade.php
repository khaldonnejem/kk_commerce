@extends('site.master')

@section('title', 'Cart | ' . config('app.name'))


@section('content')

    <section class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="content">
                        <h1 class="page-name"> Posts API </h1>
                        <ol class="breadcrumb">
                            <li><a href="{{ route('site.index') }}">Home</a></li>
                            <li class="active">Posts API</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="page-wrapper">
        <div class="cart shopping">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="block">
                            {{-- @foreach ($posts as $post)
                                <h2>{{ $post['title'] }}</h2>
                                <p>{{ $post['body'] }}</p>
                                <hr>
                            @endforeach --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>




    {{-- ways ajax(
        1- java script.
        2- axios.  //resources>>js>>bootstrap.js
        3- fetch.
        4- jquery.
    ) --}}
    <script>

        // XMLHttpRequest
        //Fethch API
            // fetch(file)
            // .then(x => x.text())
            // .then(y => myDisplay(y));
        //Jquery Ajax
        //Axios

        //1- using ajax by Java Script js..
        // $.ajax({
        //     type: 'get',
        //     url: 'https://jsonplaceholder.typicode.com/posts',
        //     // data: {
        //     //     // we use this if the type is 'post'.
        //     // }
        //     success: function(res) {
        //         // console.log(res);
        //         // let item = '<h2>'+ff+'</h2>'
        //         // item += '<p>dwee</p>'
        //         // item += '<hr>'

        //         //tamplate literal(`)

        //         res.forEach(post => {
        //             // console.log(post);
        //             let item = `
        //             <h2>${post.title}</h2>
        //             <p>${post.body}</p>
        //             <hr>
        //         `;
        //             $('.block').append(item);

        //         })
        //     }
        // })

        //2- using ajax by axios..

        axios.get('https://jsonplaceholder.typicode.com/posts')
            .then(function (response) {
                // handle success
                // console.log(response);
                response.data.forEach(post => {
                let item =
                         `
                            <h2>${post.title}</h2>
                            <p>${post.body}</p>
                            <hr>
                         `;
                    $('.block').append(item);

                })
            })
        .catch(function (error) {
                // handle error
                console.log(error);
            })
        // .finally(function () {
        //         // always executed
        //         console.log('Finished');
        //     });

    </script>

@stop

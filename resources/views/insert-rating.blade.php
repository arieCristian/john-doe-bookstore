<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>John Doe BookStore</title>
    <link rel="shortcut icon" href="">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/">Books List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/top-authors">Top Authors</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/insert-rating">Insert Rating</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- CONTENT --}}
    <div class="container d-flex justify-content-center">
            <div class="col-lg-10 card p-4 mt-4">
                @if (session()->has('faild'))
                <div class="alert alert-danger" role="alert">
                    {{ session('faild') }}
                </div>  
                @endif
                <h1>Insert Rating</h1>
                {{-- FILTER DATA --}}
                <form action="/insert-rating" method="POST">
                    @csrf
                    <table>
                        <tr>
                            <td width="20%">
                                Book Author
                            </td>
                            <td width="5%">:</td>
                            <td><select style="width: 400px" class="form-select ml-4" name="author" id="author">
                                @foreach ($authors as $author)
                                    @if ($author->id == $authorSelected->id)
                                    <option selected value="{{ $author->id }}">{{ $author->name }}</option>
                                    @else
                                    <option value="{{ $author->id }}">{{ $author->name }}</option>    
                                    @endif
                                @endforeach
                            </select></td>
                        </tr>
                        <tr>
                            <td width="20%">
                                Book Name
                            </td>
                            <td width="5%">:</td>
                            <td><select style="width: 400px" class="form-select ml-4" name="book" id="book">
                                {!! $list !!}
                            </select></td>
                        </tr>
                        <tr>
                            <td width="20%">
                                Rating
                            </td>
                            <td width="5%">:</td>
                            <td><select style="width: 100px" class="form-select ml-4" name="rating">
                                @for ($i = 1; $i <= 10; $i++) 
                                    <option value="{{ $i }}">{{ $i }}</option>    
                                @endfor
                            </select></td>
                        </tr>
                        <tr>
                            <td>
                                
                            </td>
                            <td></td>
                            <td>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </td>
                        </tr>
                    </table>
                </form>
                {{-- END FILTER DATA --}}
            </div>
    </div>
    {{-- END CONTENT --}}



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script>
        $('#author').change(function(){
        var author = $('#author').val();
            $.get("{{ URL::to('/insert-rating') }}",{author:author}, function(data){
                $('#book').html(data);
            })
        });
    </script>
</body>

</html>

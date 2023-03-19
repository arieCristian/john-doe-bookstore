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
                        <a class="nav-link active" aria-current="page" href="/">Books List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/top-authors">Top Authors</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/insert-rating">Insert Rating</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- CONTENT --}}
    <div class="container d-flex justify-content-center">
            <div class="col-lg-10 card p-4 mt-4">
                @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>  
                @endif
                <h1>Book List</h1>

                {{-- FILTER DATA --}}
                <form action="/" method="GET">
                    <table>
                        <tr>
                            <td width="20%">
                                List Shown
                            </td>
                            <td width="5%">:</td>
                            <td><select style="width: 100px" class="form-select ml-4" name="listShown">
                                @for ($i = 10; $i <= 100; $i +=10) 
                                    @if ($i == $listShown)
                                    <option selected value="{{ $i }}">{{ $i }}</option>
                                    @else
                                    <option value="{{ $i }}">{{ $i }}</option>    
                                    @endif
                                @endfor
                            </select></td>
                        </tr>
                        <tr>
                            <td>
                                Search
                            </td>
                            <td>:</td>
                            <td>
                                <input style="width: 400px" class="form-control" type="text" placeholder="Search book or author name ..." name="search" value="{{ $search }}">
                            </td>
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

                {{-- BOOKS DATA --}}
                <table class="table table-striped mt-4">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Book Name</th>
                            <th>Category Name</th>
                            <th>Author Name</th>
                            <th>Avarage Rating</th>
                            <th>Voter</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($books as $book)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $book->book_name }}</td>
                            <td>{{ $book->category_name }}</td>
                            <td>{{ $book->author_name }}</td>
                            <td>{{ round($book->average_rating , 2) }}</td>
                            <td>{{ $book->voter }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- END BOOKS DATA --}}
            </div>
    </div>
    {{-- END CONTENT --}}



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
</body>

</html>

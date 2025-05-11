<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Summernote with PHP</title>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap CSS (required by Summernote) -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Summernote CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">
    <!-- Bootstrap JS (required by Summernote) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!-- Summernote JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>
</head>

<body>
    <div class="container">
        <h1 class="mt-5">Summernote with PHP</h1>
        <div class="row">
            <div class="col-md-12">
                <form action="save.php" method="post">
                    <textarea name="content" id=""></textarea>
                    <button type="submit" class="btn btn-primary mt-3">Save</button>
                </form>
            </div>
        </div>
    </div>
    <div class="container">
        <h1 class="mt-5">Summernote with PHP</h1>
        <div class="row">
            <div class="col-md-12">
                <form action="save.php" method="post">
                    <textarea name="content" id="summernote"></textarea>
                    <button type="submit" class="btn btn-primary mt-3">Save</button>
                </form>
            </div>
        </div>
    </div>
    <button id="edit" class="btn btn-primary" onclick="edit()" type="button">Edit 1</button>
    <button id="save" class="btn btn-primary" onclick="save()" type="button">Save 2</button>
    <div class="click2edit">click2edit</div>
    <script>
    $(document).ready(function() {
        $('#summernote').summernote({
            height: 300,
            minHeight: null,
            maxHeight: null,
            focus: true
        });
    });
    var edit = function() {
        $('.click2edit').summernote({
            focus: true
        });
    };

    var save = function() {
        var markup = $('.click2edit').summernote('code');
        $('.click2edit').summernote('destroy');
    };
    </script>
</body>

</html>
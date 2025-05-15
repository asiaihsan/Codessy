<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.min.js"></script>
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="left">
            <div class="text_run">
                <label for="">Code Editor</label>
                <button type="button" href="" class="btn btn-primary" onclick="refresh()">Run</button>
            </div>
            <div class="editor">
                <textarea name="" id="editor_textarea"></textarea>
            </div>
        </div>
        <div class="right">
            <div class="text_run">
                <label for="">Output</label>
            </div>
            <div class="output">
                <iframe src="" frameborder="0" id="output_iframe"></iframe>
            </div>
        </div>
    </div>
    <script src="../js/main.js"></script>
</body>
</html>
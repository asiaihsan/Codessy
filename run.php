

<?php

require_once 'config.php';
$id = $_GET['language_id'] ;
$lecture_id = $_GET['lecture_id'] ;
echo "language_id: " . htmlspecialchars($id) . "<br>";
echo "lecture_id: " . htmlspecialchars($lecture_id) . "<br>";
?>

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
                <button type="button" href="" class="btn btn-primary" onclick="runCode()">Run</button>
            </div>
            <div class="editor">
                <textarea style="font-family:monospace;" rows="20" cols="80" name="" id="editor_textarea">
<?php
$result = $pdo->query("SELECT lecture_code FROM lectures JOIN programing_language ON lectures.language_id = programing_language.id WHERE lectures.id = " . intval($lecture_id) . " AND programing_language.id = " . intval($id));
foreach ($result as $row) { ?>
<?php echo htmlspecialchars($row['lecture_code']); ?>
<?php } ?>
                </textarea>
            </div>
        </div>
        <div class="right">
            <div class="text_run">
                <label for="">Output</label>
            </div>
            <div class="output">
                <iframe name="output_frame" id="output_iframe" style="width: 100%; height: 300px;" frameborder="0">
                </iframe>
            </div>
             
            
        </div>
    </div>
    <script src="../js/main.js"></script>
    <script>

          const code = document.getElementById('editor_textarea').value;
    const output = document.getElementById('output_iframe');
    
    // Ensure iframe is ready
    const iframeDoc = output.contentDocument || output.contentWindow.document;
    
    // Completely replace the document to execute scripts
    iframeDoc.open();
    iframeDoc.write(code);  // This executes scripts unlike innerHTML
    iframeDoc.close();
   function runCode() {
    const code = document.getElementById('editor_textarea').value;
    const output = document.getElementById('output_iframe');
    
    // Ensure iframe is ready
    const iframeDoc = output.contentDocument || output.contentWindow.document;
    
    // Completely replace the document to execute scripts
    iframeDoc.open();
    iframeDoc.write(code);  // This executes scripts unlike innerHTML
    iframeDoc.close();
}
    </script>
</body>
</html>
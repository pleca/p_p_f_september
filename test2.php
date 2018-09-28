<?php
    echo'test';
?>

<html>
<head>
    <script
        src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
        crossorigin="anonymous"></script>
</head>
<body>
<script>
  $(document).ready(function() {
    var url = "https://192.168.4.14/getfile";

    $.ajax({
      url: url,
      type: "POST",
      data: {
        api_key: '1aa53f75-55c8-41a7-8554-25e094c71b47'
      },
      success: function(msg) {
        console.log(msg)
      },
      error: function(data) {
        console.log(data);
      }
    });
  });
</script>
</body>
</html>

<!DOCTYPE html>
<html lang="th-TH">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>TEST CSRF</title>
</head>
<body>
    <form action="test-csrf" method="POST">
        {{ csrf_field() }}
        <input type="text" name="csrf" value="{{ csrf_token() }}" />
        <button>Submit</button>
    </form>
</body>
</html>

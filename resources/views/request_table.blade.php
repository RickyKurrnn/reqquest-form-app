{{-- resources/views/request_table.blade.php --}}
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Request Data Table</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  @vite('resources/js/app.js')
</head>
<body>
  <div id="app">
    <request-table :initial-rows='@json(session("requests_demo", []))'></request-table>
  </div>
</body>
</html>

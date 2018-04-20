<!DOCTYPE html>
<html>
<head>
    <title></title>
    <!-- <script type="text/javascript" src="{{asset('public/plugins/pdfobject/pdfobject.min.js')}}"></script> -->
</head>
<style>
    *{
        margin: 0;
        padding: 0;
    }
</style>
<body>
<!-- <div id="pdf" style="width: 800px;height: 1000px;"></div>
<script type="text/javascript">
    window.onload = function() {

        PDFObject.embed("{{url('')}}/{{$path}}", "#pdf");
    };
</script> -->
<embed src="{{url('')}}/{{$path}}" style="width: 1050px;height: 500px;" type="application/pdf">
</body>
</html>

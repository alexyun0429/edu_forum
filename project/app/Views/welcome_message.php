<!DOCTYPE html>
<html>
<head>
 <style>
 .scrollable {
 height: 200px;
 overflow: auto;
 }
 </style>
</head>
<body>
 <div class="scrollable">
 <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam euismod, tortor nec pharetra ultricies, ante erat imperdiet velit, nec laoreet enim lacus a velit. Nam elementum ullamcorper orci, nec cursus velit auctor vitae.</p>
 <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam euismod, tortor nec pharetra ultricies, ante erat imperdiet velit, nec laoreet enim lacus a velit. Nam elementum ullamcorper orci, nec cursus velit auctor vitae.</p>
 <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam euismod, tortor nec pharetra ultricies, ante erat imperdiet velit, nec laoreet enim lacus a velit. Nam elementum ullamcorper orci, nec cursus velit auctor vitae.</p>
 </div>

 <script>
 let scrollable = document.querySelector('.scrollable');
 scrollable.addEventListener('scroll', function() {
 console.log('scroll event triggered');
 });
 </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <style>
        body{
            background-image: url(maxresdefault.jpg);
            background-color: rgb(14, 13, 13);
            overflow: hidden;
        }
        #space{
            
            position: relative;
            width: 100%;
            height: 500px;
        }
        .circle{
            position: absolute;
            margin: auto;
            border-radius: 50%;
            width:0px;
            height: 0px;
            background-color:beige;
            border:1px solid #ccc;
        }
    </style>
</head>
<body>
    <div id="space">
        <ul class="items">
            <?php
                foreach(array_splice(scandir("img"), 2) as $file){
                    echo "<li><img src=\"img/$file\" /></li>";
                }
            ?>
        </ul>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
            var audio = new Audio('bubble1.wav');
            $("#space ul").hide();
            var maxheight = $(document).height();
            var maxwidth = $(document).width();

            function randomColor(){
                var red       = Math.random()*255;
                var green     = Math.random()*255;
                var blue      = Math.random()*255;
                var alpha     = Math.random();
                var color     = "rgba("+red+","+green+","+blue+","+alpha+")";
                return color;
            }
            
            function randomCircle(imgindex){
                circleID    = Math.random()*10000;
                var x       = Math.random()*1200;
                var y       = Math.random()*500;
                var color   = randomColor();
                var circle  = "<img src='"+$('#space li').eq(imgindex).find('img').attr('src')+"'   id='c"+circleID+"'  class='circle free top left' style='width:0;height:0;background-color:"+color+";top:"+y+"px;left:"+x+"px' />";
                $("#space").append(circle);
            }

            var imgindex = 0;
            circlesGenerator = setInterval(function(){
                randomCircle(imgindex);
                imgindex++;
                
                if(imgindex==$('#space').find('li').length)
                    clearInterval(circlesGenerator);
            },1000);

            var animation = setInterval(function(){

                $('.circle').each(function(){
                    var width  = parseInt($(this).css("width"))+1;
                    $(this).css("transform","rotate("+Math.random()*2+"deg)");
                    if(width<100){
                        $(this).css("width",width+'px');
                        $(this).css("height",width+'px');
                    }
                    $(this).on('click',function(){
                        
                        audio.play();
                        $(this).remove();
                    });
                });   

                $('.top').each(function(){
                    var top  = parseInt($(this).css("top"))-(Math.round(Math.random()*5));
                    if(top<10){
                        $(this).removeClass('top');
                        $(this).addClass('bottom');
                    }
                    $(this).css("top",top+'px');
                });
                
                $('.bottom').each(function(){
                    var top = parseInt($(this).css("top"))+(Math.round(Math.random()*5));
                    
                    if(top>maxheight){
                        $(this).removeClass('bottom');
                        $(this).addClass('top');
                    }
                    $(this).css("top",top+'px');
                });

                $('.left').each(function(){
                    var left = parseInt($(this).css("left"))+(Math.round(Math.random()*5));
                    
                    if(left>maxwidth){
                        $(this).removeClass('left');
                        $(this).addClass('right');
                    }
                    $(this).css("left",left+'px');
                });

                $('.right').each(function(){
                    var left = parseInt($(this).css("left"))-(Math.round(Math.random()*5));
                    if(left<10){
                        $(this).removeClass('right');
                        $(this).addClass('left');
                    }
                    $(this).css("left",left+'px');
                });
            },100);

           
    </script>
</body>
</html>
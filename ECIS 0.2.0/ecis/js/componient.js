window.addEventListener("load", function(){
    var dropLists = document.getElementsByClassName("drop-list--hover");

    for(var i = 0; i < dropLists.length; ++i) {

        var button = dropLists[i].getElementsByClassName("drop-list__button");
        var menu = dropLists[i].getElementsByClassName("drop-list__menu");

        if(button.length === 0)
            console.warn("No \"#drop-list__button\" found in \"#drop-list\" element.");
        else if (menu.length === 0)
            console.warn("No \"#drop-list__menu\" found in \"#drop-list\" element.");
        else {
            if(button.length > 1)
                console.warn("More than 1 \"#drop-list__button\" found in \"#drop-list\" element.");
            if(menu.length > 1)
                console.warn("More than 1 \"#drop-list__menu\" found in \"#drop-list\" element.");
            
            // Add the down arrow
            button[0].innerHTML += "<div class=\"drop-list__button__arrow\"> </div>";
            //当鼠标移动到按钮上，则隐藏打开列表
            button[0].addEventListener("mouseover", function() {
                var thisMenu = menu[0]; //外层函数保存本轮循环的button
                return function() {
                    
                    if(thisMenu.style.display == "none" 
                    || thisMenu.style.display == "")
                        thisMenu.style.display = "block";
    
                }
            }());
            // 当鼠标离开，则隐藏关闭列表。
            dropLists[i].addEventListener(
                "mouseout", 
                function() {
                    var thisMenu = menu[0]; //外层函数保存本轮循环的button
                    return function(event) {
                        // 由于鼠标移出列表内部的某个元素时也会触发mouseout事件
                        // 所以必须判断是不是真的移出了整个列表
                        if(event.target.className == "drop-list--hover")
                            thisMenu.style.display = "none"; 
                    }
                }(),
                false
            );
            // 当列表被点击，切换打开和关闭的状态
            dropLists[i].addEventListener("click", function() {
                var thisMenu = menu[0]; //外层函数保存本轮循环的button
                return function() {
                    if(thisMenu.style.display == "none" 
                    || thisMenu.style.display == "")
                        thisMenu.style.display = "block";
                    else
                        thisMenu.style.display = "none";
                }
            }());
        }
    }

})


function MsgArea(htmlElement) {
    if(!htmlElement || htmlElement.innerHTML == undefined)
        throw new Error("Not a invalid html element");

    this.target = htmlElement;
    this.error = function(msg) {
        this.target.innerHTML = 
        "<div class=\"msg--error\">" + 
        "<img class=\"msg__icon\" src=\"img/error.svg\"/>"
         + msg + "</div>"
    };
    this.warn = function(msg) {
        this.target.innerHTML = 
        "<div class=\"msg--warn\">" + 
        "<img class=\"msg__icon\" src=\"img/warn.svg\"/>"
         + msg + "</div>"
    };
    this.info = function(msg) {
        this.target.innerHTML = 
        "<div class=\"msg--info\">" + 
        "<img class=\"msg__icon\" src=\"img/info.svg\"/>"
         + msg + "</div>"
    };
    this.ok = function(msg) {
        this.target.innerHTML = 
        "<div class=\"msg--ok\">" + 
        "<img class=\"msg__icon\" src=\"../img/ok.svg\"/>"
         + msg + "</div>"
    };
    this.clear = function() {
        this.target.innerHTML = "";
    }
}

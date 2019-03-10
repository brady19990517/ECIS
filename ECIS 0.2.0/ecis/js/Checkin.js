var lastInput;
var msgArea;
var info_area = {
    name: "",
    group: "",
    id: "",
    emphasize: "group",
    refresh: function() {
        var keys = ["name", "group", "id"];
        var table = "<table>";
        for(var i in keys) {
            //若某个值为空，说明有错误，则不显示
            if(keys[i] === null || keys[i] === undefined)
                return;
            //将几个值整合进一个表格
            table += "<tr>" 
            + "<th>" + keys[i] + "</th>"    //头部是名称
            + "<td>" + this[keys[i]] + "</td>"  //对应的值
            + "</tr>";
        }
        table += "</table>";
        document.getElementById("info-area__table").innerHTML = table;

        if(this.emphasize != "none") {
            document.getElementById("info-area__emphasize__title").innerHTML = 
            this.emphasize;
            document.getElementById("info-area__emphasize__content").innerHTML = 
            this[this.emphasize];
        } else {
            document.getElementById("info-area__emphasize__title").innerHTML = 
            document.getElementById("info-area__emphasize__content").innerHTML = "";
        }
    },
    clear: function() {
        document.getElementById("info-area__table").innerHTML
        = document.getElementById("info-area__emphasize__title").innerHTML
        = document.getElementById("info-area__emphasize__content").innerHTML = "";
    }
};

window.addEventListener("load", function(){

    var idInput = document.getElementById("student-id__input");
    
    // 加载后自动聚焦到输入框
    idInput.focus();
    
    window.addEventListener("keyup", function(event){
        // 如果target不是输入框，则没有聚焦
        if(event.target.id != "student-id__input"
        && event.keyCode == 16)
        //若按下Shift键
            idInput.focus();
    });

    idInput.addEventListener("keydown", function(event) {
        //上下键查阅上一条历史输入
        if(event.keyCode == 38 || event.keyCode == 40) {
            //向上向下键
            var temp = idInput.value;
            idInput.value = lastInput;
            lastInput = temp;
        } 
        //按下回车键提交
        else if(event.keyCode == 10 || event.keyCode == 13) {
            submit(idInput.value);
            //记录
            lastInput = idInput.value;
            //清空原有值
            idInput.value = "";
        }
    })

    msgArea = new MsgArea(document.getElementById("msg-area"));

});

function submit(value) {
    //若值为空
    if(value === "")
        msgArea.error("The input cannot be empty.");
    else
        ajax.get(
            "action/checkin_mysql.php?q=" + value + "&activity=" + document.getElementById("act").value + "&condi=checkin",
            function(status, xhr) {
                //如果状态码表示成功
                if(ajax.isSuccess(status)) {
                    // 当错误时，xmlDoc == null或者undefined
                    try{
                        var xmlDoc = stringToXml(xhr.responseText);
                        showMsg(valueOfTag(xmlDoc, "status"), value);
                        showInfo(xmlDoc);
                    }
                    catch(error) {
                        msgArea.error("Program error. Please change a browser or contect programmers.");
                        console.warn(error);
                    }

                } else {
                    //若错误，报告网络错误。
                    msgArea.error("Network error " + status + ". Please try again or contect with programmers.");
                    console.log(xhr);
                }
            }
        );
     
}

function showMsg(status, value) {
    try {
        switch(status) {
            case "success": 
                msgArea.ok("Checked in successfully.");
                break;
            case "already": 
                msgArea.warn("Duplicated check-in.");
                break;
            case "special":
                msgArea.warn(value + " is a special participator.");
                break;
            case "fail":
                msgArea.error(value + " not found in namelist.");
                break;
            default:
                msgArea.error("Data error. Please contect with programmers.");
                console.warn("Unknown status \"" + status + "\" in xml." );
                break;
        }
    }catch(error) {
        msgArea.error("Data error. Please contect with programmers.");
        console.warn(error);
    }
    
}

function showInfo(xmlDoc) {
    try {
        if(valueOfTag(xmlDoc, "status") != "fail") {
            info_area.name = valueOfTag(xmlDoc, "student_name");
            info_area.id = valueOfTag(xmlDoc, "student_id");
            info_area.group = valueOfTag(xmlDoc, "student_group");
            info_area.refresh();
        } else
            info_area.clear();
    }catch(error) {
        console.warn(error);
        msgArea.error("Data error. Please contect with programmers.");
    }
}

function valueOfTag(xmlDoc, tagName) {
    return xmlDoc.getElementsByTagName(tagName)[0].textContent;
}

function modifyEmphasize(event) {
    info_area.emphasize = event.target.value;
    info_area.refresh();
}


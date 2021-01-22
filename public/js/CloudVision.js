/* global $ */

//section 1
//APIを利用する際のURLになります
var KEY = 'AIzaSyChPY8yHU7tm53D0if7YPd1jzkFjWKTiaY';
var url = 'https://vision.googleapis.com/v1/images:annotate?key=';
var api_url = url + KEY;

//section 2
//ページを読み込む際に動的にラベル検出結果表示用のテーブルを作成
$(function(){
    for (var i =0; i < 10; i++){
        $("#resultBox").append("<tr><td class='resultTableContent'></td></tr>");
    }
});

//section 3
//画面の表示内容をクリアする処理
function clear(){
    if($("#textBox tr").length){
        $("#textBox tr").remove();
    }
    if($("#chartArea div").length){
        $("#chartArea div").remove();
    }
    $("#resultBox tr td").text("");
}

//section 4
//画像がアップロードされた時点で呼び出される処理
// $("#uploader").change(function(evt){
//     getImageInfo(evt);
//     clear();
//     $(".resultArea").removeClass("hidden");
// });

$(function(){
$("#uploader").change(function(evt){
    getImageInfo(evt);
    clear();
    $(".resultArea").removeClass("hidden");
});
});


//section 5
//画像ファイルを読み込み、APIを利用するためのURLを組み立てる
function getImageInfo(evt){
    var file = evt.target.files;
    var reader = new FileReader();
    var dataUrl = "";
    reader.readAsDataURL(file[0]);
    reader.onload = function(){
        dataUrl = reader.result;
        $("#showPic").html("<img src='" + dataUrl + "'>");
        makeRequest(dataUrl,getAPIInfo);
    };
}

//section 6
//APIへのリクエストに組み込むJsonの組み立て
function makeRequest(dataUrl,callback){
    var end = dataUrl.indexOf(",");
    var request = "{'requests': [{'image': {'content': '" + dataUrl.slice(end + 1) + "'},'features': [{'type': 'LABEL_DETECTION','maxResults': 10,},{'type': 'FACE_DETECTION',},{'type':'TEXT_DETECTION','maxResults': 20,}]}]}";
    callback(request);
}

//section 7
//通信を行う
function getAPIInfo(request){
    $.ajax({
        url : api_url,
        type : 'POST',       
        async : true,        
        cashe : false,
        data: request, 
        dataType : 'json', 
        contentType: 'application/json',   
    }).done(function(result){
        showResult(result);
    }).fail(function(result){
        alert('failed to load the info');
    });
}

//section 8
//得られた結果を画面に表示する
function showResult(result){
    //ラベル検出結果の表示
    for (var i = 0; i < result.responses[0].labelAnnotations.length;i++){
        $("#resultBox tr:eq(" + i + ") td").text(result.responses[0].labelAnnotations[i].description);
    }

    //テキスト解読の結果を表示
    if(result.responses[0].textAnnotations){
        for (var j=1; j<result.responses[0].textAnnotations.length; j++){
            if(j < 75){
                // $("#textBox").append("<tr><td class='resultTableContent'>" + result.responses[0].textAnnotations[j].description + "</td></tr>")
                // $("#textBox").append("<tr><td class='resultTableContent'>" + result.responses[0].textAnnotations[j].description + "</td></tr>" + "<button onclick='copy()'>" + "copy" + "</button>")
                // $("#textBox").append("<textarea>" + result.responses[0].textAnnotations[j].description + "</textarea>" + "<button onclick='copy()'>" + "copy" + "</button>")
                // $("#textBox").append("<p>" + result.responses[0].textAnnotations[j].description + "</p>" + "<button onclick='copy()'>" + "copy" + "</button>")

                // $("#optional").append("<tr><td class='resultTableContent'>" + result.responses[0].textAnnotations[j].description + "</td></tr>")
                // $("#optional").append("<tr><td class='resultTableContent'>" + result.responses[0].textAnnotations[j].description + "</td></tr>" + "<button onclick='copy()'>" + "copy" + "</button>")
                $("#optional").append("<text>" + result.responses[0].textAnnotations[j].description + "</text>" );
                // $("#optional").append("<text>" + result.responses[0].textAnnotations[j].description + "</text>" + "<button onclick='copy("+j+")'>" + "copy" + "</button>");
                // $("#optional").append("<textarea id='"+j+"'>" + result.responses[0].textAnnotations[j].description + "</textarea>" + "<button onclick='copy("+j+")'>" + "copy" + "</button>")

                // $("#optional").append("<p>" + result.responses[0].textAnnotations[j].description + "</p>" + "<button onclick='copy()'>" + "copy" + "</button>")

                // $("#textBox").append(result.responses[0].textAnnotations[j].description)
                // $("#textBox").append(result.responses[0].textAnnotations.length)

                // $("#textBox").append(result.responses[0].textAnnotations[13].description);
                console.log(result.responses[0].textAnnotations[j].description);
                // console.log(result.responses[0].textAnnotations[16].description);
            }
        }
    }else{
        //テキストに関する結果が得られなかった場合、表示欄にはその旨を記す文字列を表示
        $("#textBox").append("<tr><td class='resultTableContent'><b>No text can be found in the picture</b></td></tr>");
    }
}


    // function copy(j) {
    //     var text = document.getElementsByTagName("textarea")[j-1];
    //     text.select();
    //     document.execCommand("copy");
    // }
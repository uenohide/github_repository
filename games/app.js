var targetTime = 10; // 目標時間
var time  = 0;       // 経過時間
var timer = null     // タイマー

var toggle = document.getElementById('toggle');
toggle.addEventListener('click', function(event) {
    // トグルボタンの状態判定
    status = toggle.value;
    if (status === 'start') {
        timerStart();
        toggle.value = 'stop';
        toggle.classList.add('stop');
    } else {
        timerEnd();
        getResult2();
        setTimeout("getResult()",2500);
    }
});

function timerStart() {
    // 経過時間を更新する
    var resultImage = document.getElementById("toggle");
    resultImage.src = "./img/0.png";

    startTime = new Date().getTime();
    timer = setInterval(function() {
        time = (new Date().getTime() - startTime) / 1000;
        document.getElementById('timer').textContent = time.toFixed(3); 
    }, 10);
}
function timerEnd(){
	clearInterval(timer);
	timer = null;
}
function getResult(){
    
    //alert(time + '秒でした。');
    //結果をサーバに送信する。
    var result = Math.abs(targetTime - time);
    var form = document.createElement('form');
    form.action = "result.php";
    form.method = "post";
    form.innerHTML = "<input name='result' type='hidden' value='" + result + "'>";
    document.body.appendChild(form); // FireFox & IE 対策 (HTML内にformがないとsubmitが動かない)
    form.submit();
}

function getResult2(){
var resultImage = document.getElementById("toggle");
if(time == 10 ){
    resultImage.src = "./img/0.png";
    }else{
    	resultImage.src = "./img/bakudan01_05.png";
    }

}
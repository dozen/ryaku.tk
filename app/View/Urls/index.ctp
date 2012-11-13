<script type="text/javascript">
    $(function(){
        function send() {
            var url = "api.json?url=" + $(".url").val();
            $.getJSON(url, function(data){
                $(".result").text(data.url);
            });
        }
        
        $(".do").click(function(){
            send();
        });
        $('.url').keypress(function (e) {
            if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {
                send();
            }
        });
    });
</script>

<span>略.tkはサブドメイン・日本語ドメインに対応した数少ないURL短縮サービスです。</span><br>

<div id="form">
    <input class="url parts" type="text" placeholder="ここにURLを入力">
    <button class="do parts">短縮！</button>
    <span class="result parts">http://〇.略.tk</span>
</div>
<p><span class="count"><?php echo $urlCount ?></span>個のURLが短縮されました。</p>

<div id="api">
    <h2>APIもあるよ</h2>
    JSON, XML, Plain textに対応したAPIを用意しています。
    <p>
        http://略.tk/api.{format}?url={url}<br>
        format=json,xml,txt
    </p>
    <p>
        返される結果については試してみてください。<br>
        (近日中に用意しておきます＞＜)
    </p>
</div>
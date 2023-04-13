$(function () {
    // 編集ボタン(class="js-modal-open")が押されたら発火
    $(".js-modal-open").on("click", function () {
        // モーダルの中身(class="js-modal")の表示
        $(".js-modal").fadeIn();
        // 押されたボタンから投稿内容を取得し変数へ格納
        var post = $(this).attr("post");
        // 押されたボタンから投稿のidを取得し変数へ格納（どの投稿を編集するか特定するのに必要な為）
        var post_id = $(this).attr("post_id");

        // 取得した投稿内容をモーダルの中身へ渡す
        $(".modal_post").text(post);
        // 取得した投稿のidをモーダルの中身へ渡す
        $(".modal_id").val(post_id);
        return false;
    });

    // 背景部分や閉じるボタン(js-modal-close)が押されたら発火
    $(".js-modal-close").on("click", function () {
        // モーダルの中身(class="js-modal")を非表示
        $(".js-modal").fadeOut();
        return false;
    });
});

$(document).ready(function () {
    $("a[href^='post']").click(function (e) {
        e.preventDefault();
        var link = $(this).attr("href");
        var confirmation = confirm("この投稿を削除します。よろしいですか？");
        if (!confirmation) {
            return false;
        } else {
            window.location.href = link;
        }
        // OKとキャンセルの位置を逆にするために、ボタンの順序を変更する
        $(".ui-dialog-buttonset button:first").addClass(
            "ui-priority-secondary"
        );
        $(".ui-dialog-buttonset button:last").addClass("ui-priority-primary");
    });
});

$(function () {
    // 画像が選択されていない場合、<img>要素を非表示にする
    $("#preview-image").hide();
    // 画像が選択されていない場合、<span>要素を表示する
    $(".drop-message").show();
    // ドロップエリアにイベントを追加
    $(".drop-area").on("dragover", function (e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).addClass("dragover");
    });
    $(".drop-area").on("dragleave", function (e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).removeClass("dragover");
    });
    $(".drop-area").on("drop", function (e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).removeClass("dragover");
        // ドロップされたファイルを取得
        var files = e.originalEvent.dataTransfer.files;
        // FileReaderオブジェクトを生成
        var reader = new FileReader();
        // 読み込みが完了した時の処理
        reader.onload = function () {
            // 読み込んだファイルの内容を<img>タグに設定
            $("#preview-image").attr("src", reader.result);
            $(".drop-message").hide();
            $("#preview-image").show();
        };
        // ファイルを読み込む
        reader.readAsDataURL(files[0]);

        // hidden input要素に選択されたファイルを設定
        var formData = new FormData();
        formData.append("imgpath", files[0]);
        $("#hidden-form").attr("data-imgpath", files[0].name);
        $("#hidden-form input[name='imgpath']").val("");
        $("#hidden-form input[name='imgpath']").removeAttr("value");
        $("#hidden-form input[name='imgpath']").prop("files", files);
    });

    // input[type="file"]にイベントを追加
    $('input[type="file"]').on("change", function (e) {
        // 選択されたファイルを取得
        var files = e.target.files;
        // FileReaderオブジェクトを生成
        var reader = new FileReader();
        // 読み込みが完了した時の処理
        reader.onload = function () {
            // 読み込んだファイルの内容を<img>タグに設定
            $("#preview-image").attr("src", reader.result);
            $(".drop-message").hide();
            $("#preview-image").show();
        };
        // ファイルを読み込む
        reader.readAsDataURL(files[0]);
    });
});

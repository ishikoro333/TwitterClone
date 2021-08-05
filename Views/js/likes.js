/////////////////////
/////いいね！のjavascript
/////////////////////

$(function(){
    //いいねがクリックされた時
    $('.js-likes').click(function(){
        const this_obj =$(this);
        const likes_id =$(this).data('likes-id');
        const likes_count_obj =$(this).parent().find('.js-likes-count');
        let likes_count = Number(likes_count_obj.html());

        if(likes_id) {
            //いいね！取り消し
            //いいね！カウントを減らす
            likes_count--;
            likes_count_obj.html(likes_count);
            this_obj.data('likes-id',null);
            //いいね！ボタンの色をグレーに変更
            $(this).find('img').attr('src','../Views/img/icon-heart.svg');
        } else{
            //いいね！付与
            //いいね！カウントを増やす
            likes_count++;
            likes_count_obj.html(likes_count);
            this_obj.data('likes-id',true);
            //いいね！ボタンの色を青に変更
            $(this).find('img').attr('src','../Views/img/icon-heart-twitterblue.svg');

        }
    });
})
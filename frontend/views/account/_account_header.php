<form id="changeImageProfile" action="/ajax/avatar" method="post" enctype="multipart/form-data">
    <div class="banner-02" id="banner-user-image" style="background-image:url('<?php echo \Yii::$app->user->identity->getImage(); ?>')">
        <div class="container">
            <div class="">
                <img src="<?php echo \Yii::$app->user->identity->getAvatar(); ?>" width="200" class="img-circle"/>
                <div class="big-name"><h1><?php echo \Yii::$app->user->identity->getName(); ?></h1></div>
                <div>
                    <a href="javascript:void(0);" class="link" id="user-avatar" onclick="$('#user-avatar-upload').click();">Đổi Avatar</a> 
                    <a href="javascript:void(0);" class="link" id="user-image" onclick="$('#user-image-upload').click();">Đổi ảnh nền</a>   
                    <div style="display: none;">
                        <input type="file" id="user-avatar-upload"/>                        
                        <input type="file" id="user-image-upload"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
   
   <script type="text/javascript" src="assets/plugins/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="assets/plugins/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="assets/plugins/bootstrap/js/bootstrap.min.js"></script> 
    <script type="text/javascript" src="assets/plugins/bootstrap-hover-dropdown.min.js"></script>
    <style>
    .signup-form
    {
        margin: auto;
        width: 100%;
    }
    .file_upload{
    display: block;
    position: relative;
    overflow: hidden;
    font-size: 1em;              
    height: 2em;                 
    line-height: 2em;             
    vertical-align: middle;
}
.file_upload .button, .file_upload > mark{
    display: block;
    cursor: pointer;              
}
.file_upload .button{
    float: right;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
    width: 8em;                 
    height: 100%;
    text-align: center;           
}
.file_upload > mark{
    background: transparent;     
    padding-left: 1em            
}
@media only screen and ( max-width: 500px ){  
    .file_upload > mark{
        display: none
    }
    .file_upload .button{
        width: 100%
    }
}
.file_upload input[type=file]{
    position: absolute;
    top: 0;
    opacity: 0
}

.file_upload{
    border: 1px solid #ccc;
    border-radius: 3px;
    box-shadow: 0 0 5px rgba(0,0,0,0.1);
    transition: box-shadow 0.1s linear
}
.file_upload.focus{
    box-shadow: 0 0 5px rgba(0,30,255,0.4)
}
.file_upload .button{
    text-align: center;
    line-height: 1.65em;
    margin-bottom: 5px;
    border-radius: 2px;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;

}
#insert
{
    position: absolute;
    top: 10px;
    left: 10px;
}
.file_upload:hover .button{
}
.file_upload:active .button{
}
.upper-wrapper{
    margin-top: <?=$margin?>;
}
</style>
        <!-- ******BLOG LIST****** --> 
         <div class="row" id="ticket-box">
            <div class="col-md-offset-1 col-sm-offset-1 col-xs-offset-0" id="menu-box">
                <section class="features-tabbed section">
                    <div id="menu">                    
                        <ul class="nav" style="">   
                            
                            <li class="nav-item"<?=$help?>></li>
                        </ul>
                        <div id="scrollMenu">
                            <ul class="nav">
                                <li> <?=$options?></li>
                                <!--//dropdown-->                                            
                                
                                        <?=$mail?>
    
                                 
                                        <?=$closedMail?>
                                        
                            </ul>
                        </div>
                        <ul class="nav">
                            <li><input class="form-control" style="border-radius: 0;" type="text" id="ticket-hash" placeholder="Поиск по ФИО" onchange="findUser()" autocomplete="off"></li>
                        </ul>
                        </div><!--//tab-pane-->
                </section>
            </div>

            <div class="" id="message-box" class="col-xs-6">
            
            <div style="display: flex;"><a id="turn-back" onclick="goBackToMenu()" style="cursor: pointer;"><i class="fa fa-chevron-left" aria-hidden="true"></i></a><div id="ticket-header"></div></div>
            <div class = "textarea"></div>
            <div style="clear: both;"></div>
                <div class="desc">
                
                            </div><!--//desc-->
                            
            </div>
        </div>
        
        <script>
        window.onload = function(){
            var listener = new window.keypress.Listener();
    
    listener.register_combo({
    "keys"              : "meta enter",
    "on_keydown"        : null,
    "on_keyup"          : function(){
        sendNewMessage($("#sendd").attr("pro"), $("#sendd").attr("adm"));
    },
    "on_release"        : null,
    "this"              : undefined,
    "prevent_default"   : false,
    "prevent_repeat"    : false,
    "is_unordered"      : false,
    "is_counting"       : false,
    "is_exclusive"      : true,
    "is_solitary"       : false,
    "is_sequence"       : false
});
}
</script>

<script id="adminTemplate" type="text/html">
	<section class="features-tabbed section" style="padding-bottom: 0;">
		<div class="container admin-explorer-wrapper">
			<div class="row">
				<div class=" text-center col-md-12 col-sm-12 col-xs-12 col-md-offset-0 col-sm-offset-0 col-xs-offset-0">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs text-center admin-controls">
						<li>
							<a id="new-file-btn" class="isDisabled" onclick="prepareUpload()">
							<span class=""><i class="fas fa-plus"></i> Добавить файл</span></a>
						</li>
						<li>
							<a id="new-folder-btn" class="isDisabled">
							<span class=""><i class="fas fa-plus"></i> Добавить папку</span></a>
						</li>
						<li class="active" onclick="getObjectFolders()">
							<a data-toggle="tab" href="#folders-wrapper" role="tab">
							<span class=""><i class="fas fa-folder"></i> Папки</span></a>
						</li>
						<li onclick="getUserInfo()">
							<a data-toggle="tab" href="#user-info-wrapper" role="tab">
							<span class=""><i class="fas fa-user-tie"></i> Владелец</span></a>
						</li>
						<li onclick="getAdminInfo()">
							<a data-toggle="tab" href="#admin-info-wrapper" role="tab">
							<span class=""><i class="fas fa-cog"></i> Администратор</span></a>
						</li>
						<li onclick="newRenderer.getOtherFunctions()">
						    <a data-toggle="tab" href="#other-functions-wrapper" role="tab"><i class="fas fa-bars fa-2x"></i></a>
						</li>
					</ul><!--//nav-tabs-->
					<!-- Tab panes -->
					<div class="tab-content">
						<div class="tab-pane active" id="folders-wrapper">
							<h3 class="title sr-only">Сводка</h3>
							<div class="desc text-left">
                                <div class="">
									<div class="row">
										<div class="content-area col-md-12 col-sm-12 col-xs-12">
										    
										    <div id ="folders">
										        {{&folderTree}}
											
											    {{&fileData}}
											</div>
										</div><!--//content-area-->
									</div><!--//row-->
								</div><!--//container-->
							</div><!--//desc-->
						</div><!--//tab-pane-->
						<div class="tab-pane" id="user-info-wrapper">
							<h3 class="title sr-only">Данные аккаунта владельца</h3>
							<div class="desc text-left">
                                <div class="">
									<div class="row">
										<div class="content-area col-md-12 col-sm-12 col-xs-12" id="user-info">
											
										</div><!--//content-area-->
									</div><!--//row-->
								</div><!--//container-->
							</div><!--//desc-->
						</div><!--//tab-pane-->
						<div class="tab-pane" id="admin-info-wrapper">
							<h3 class="title sr-only">Данные администратора</h3>
							<div class="desc text-left">
                                <div class="">
									<div class="row">
										<div class="content-area col-md-12 col-sm-12 col-xs-12" id="admin-info">
											
										</div><!--//content-area-->
									</div><!--//row-->
								</div><!--//container-->
							</div><!--//desc-->
						</div><!--//tab-pane-->
						<div class="tab-pane" id="other-functions-wrapper">
							<h3 class="title sr-only">Другое</h3>
							<div class="desc text-left">
                                <div class="">
									<div class="row">
										<div class="content-area col-md-12 col-sm-12 col-xs-12" id="other-functions">
											
										</div><!--//content-area-->
									</div><!--//row-->
								</div><!--//container-->
							</div><!--//desc-->
						</div><!--//tab-pane-->
					</div><!--//tab-content-->
				</div><!--//col-md-x-->
			</div><!--//row-->
		</div><!--//container-->
	</section><!--//features-tabbed-->
</script>

<script id="folderTreeTemplate" type="text/html">
    <div id="folder-tree">
        <p>
            <a onclick="moveToUser({{userId}})">{{userName}}</a> 
            <span id="folder-tree-content">{{&tree}}</span> 
        </p>
	</div>
</script>

<script id="fileTreeTemplate" type="text/html">
    /
    {{#object}}
        <a onclick="newRenderer.getObjectData({{objectId}})">{{objectName}}</a>
    {{/object}}
    
    {{#tree}}
        / <a onclick="openFolder({{folderId}})">{{folderName}}</a>
    {{/tree}}
    
    {{#isArend}}
        <button class="btn btn-cta-secondary btn-delete" onclick="putTenantIntoArchive({{folderId}})">Переместить арендатора в архив</button>
    {{/isArend}}
</script>

<script id="fileSystemTemplate" type="text/html">
    <div id="file-system" user-id="{{userId}}" {{#objectId}}object-id="{{objectId}}"{{/objectId}} {{#folderId}}folder-id="{{folderId}}"{{/folderId}}>
    {{&content}}
    </div>
</script>

<script id="fileSystemContentTemplate" type="text/html">
    {{#objects}}
        <div class="file-item">
            <a class="file-link" onclick="newRenderer.getObjectData({{objectId}})">
                <span style="font-size: 45px;"><i class="fas fa-home"></i></span><br/>
                <span>{{objectName}}</span>
            </a>
        </div>
    {{/objects}}
    
    {{#folders}}
        <div class="file-item">
        {{#editableName}}
            <a class="delete-file" onclick="changeFolderName({{folderId}})"><i class="fas fa-edit"></i></a>
        {{/editableName}}
            <a class="file-link" onclick="openFolder({{folderId}})">
                <span style="font-size: 45px;"><i class="fas fa-folder"></i></span><br/>
                <span id="folder-{{folderId}}-name">{{folderName}}</span>
            </a>
        </div>
    {{/folders}}
    
    {{#files}}
        <div class="file-item">
            <a class="delete-file" onclick="deleteFile({{fileId}})"><i class="fas fa-times-circle"></i></a>
            <a class="file-link" href="{{fileHref}}" target="_blank">
                <span style="font-size: 45px;"><i class="fas fa-file"></i></span><br/>
                <span>{{fileName}}</span>
            </a>
        </div>
    {{/files}}
    
</script> 

<script id="userInfoTemplate" type="text/html">
    <table class="table table-striped" id="user-info" user-id="{{userId}}">
      <tbody>
        <tr>
          <td>Имя</td>
          <td id="user-name">{{name}} <a onclick="changeUserParam('name', '{{name}}')"><i class="fas fa-edit"></i></a></td>
        </tr>
        <tr>
          <td>Фамилия</td>
          <td id="user-surname">{{surname}} <a onclick="changeUserParam('surname', '{{surname}}')"><i class="fas fa-edit"></i></a></td>
        </tr>
        <tr>
          <td>Серия и номер паспорта</td>
          <td id="user-passport">{{passport}} <a onclick="changeUserParam('passport', '{{passport}}')"><i class="fas fa-edit"></i></a></td>
        </tr>
        <tr>
          <td>Дата рождения</td>
          <td id="user-birthday">{{birthday}} <a onclick="changeUserParam('birthday', '{{birthday}}')"><i class="fas fa-edit"></i></a></td>
        </tr>
        <tr>
          <td>№ счета</td>
          <td id="user-account">{{account}} <a onclick="changeUserParam('account', '{{account}}')"><i class="fas fa-edit"></i></a></td>
        </tr>
        <tr>
          <td>Биометрия</td>
          <td id="user-biometry">
              <a id="biometry-link" class="btn btn-cta-primary" href="public_html/ticket_files/{{id}}/{{biometry}}" target="_blank">Скачать</a> 
              <button class="btn btn-cta-primary" style="margin-left: 10px;" id="upload-biometry">Загрузить</button>
          </td>
        </tr>
        <tr>
          <td>Емейл</td>
          <td id="user-email">{{email}} <a onclick="changeUserParam('email', '{{email}}')"><i class="fas fa-edit"></i></a></td>
        </tr>
        <tr>
          <td>Пароль</td>
          <td id="user-password">******** <a onclick="changeUserParam('password')"><i class="fas fa-edit"></i></a></td>
        </tr>
      </tbody>
</table>

<button id="user-delete-btn" onclick="deleteUser()" class="btn btn-cta-secondary btn-delete">Удалить пользователя</button>
</script>

<script id="adminInfoTemplate" type="text/html">
    <h2 class="text-center">Настройки объекта</h2>
    <p>
        Название объекта 
        <input type="text" class="form-control" id="new-object-name" value="{{objectName}}" /> 
        <button id="new-object-name-btn" onclick="updateObjectName({{objectId}})" class="btn btn-cta-primary">Подтвердить</button>
        <button id="object-delete-btn" onclick="deleteObject({{objectId}})" class="btn btn-cta-secondary btn-delete">Удалить объект</button>
    </p>
    
    <h3 class="text-center">Порядок следования папок</h3>
    {{#userOrderDates}}
    <h3>{{dateHeader}}</h3>
    <table class="table table-striped" id="user-order-{{tableId}}">
        <tbody>
            {{#userOrder}}
                <tr>
                    <td>{{name}}</td>
                    <td><input type="number" min="1" onchange="changeOrderNumbers({{id}}, 'user-order-{{tableId}}')" folder-id="{{id}}" value="{{user_order}}" class="form-control"/></td>
                </tr>
            {{/userOrder}}
        </tbody>
    </table>
    <button id="user-order-btn-user-order-{{tableId}}" class="btn btn-cta-primary" onclick="updateUserOrder('user-order-{{tableId}}')">Подтвердить</button>
    {{/userOrderDates}}
    
    <h2 class="text-center">Настройки администратора</h2>
    <table class="table table-striped" id="admin-info">
      <tbody>
        <tr>
          <td>Емейл</td>
          <td id="admin-email">{{email}} <a onclick="changeAdminParam('email', '{{email}}')"><i class="fas fa-edit"></i></a></td>
        </tr>
        <tr>
          <td>Пароль</td>
          <td id="admin-password">******** <a onclick="changeAdminParam('password')"><i class="fas fa-edit"></i></a></td>
        </tr>
      </tbody>
</table>
</script>

<script id="objectNewsTemplate" type="text/html">
    <ul class="nav col-xs-6">
        <li onclick="newRenderer.getOtherFunctions()"><a><i class="fas fa-angle-left"></i> Назад</a></li>
    </ul>
    <div id="add-object-news">
        <div class="form-group">
            <label class="sr-only" for="problem1">Введите текст новости</label>
            <textarea id="new-news" class="form-control" name="problem1" rows="5" placeholder="Введите текст новости"></textarea>
        </div><!--//form-group-->
        <button class="btn btn-cta-primary btn-block" id="new-news-btn" onclick="addObjectNews()">Добавить новость</button>
    </div>
    
    {{#news}}
        <div class="news-group" id="news-{{id}}">
            <strong>Новость от <span class="news-date-wrapper">{{datecreate}}</span></strong>
            <div class="news-text-wrapper">
                <p>{{&text}}</p>
            </div>
            <button class="btn btn-cta-secondary float-right" onclick="editNews({{id}})">Изменить</button>
            <button class="btn btn-cta-secondary btn-delete" onclick="deleteNews({{id}})">Удалить новость</button>
            <div class="clearfix"></div>
        </div>
    {{/news}}
</script>

<script id="otherFunctionsTemplate" type="text/html">
    <ul class="nav">
        <li onclick="getObjectNews()"><a>Новости</a></li>
    </ul>
</script>

<div class="modal fade" id="newFile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Добавить новый файл</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id='new-file-wrapper' style='margin: 15px 0 0;'>
            <div class="form-group">
                <label class="sr-only" for="scan-commentary">Комментарий</label>
                <textarea id="scan-commentary" class="form-control" name="scan-commentary" rows="5" placeholder="Комментарий"></textarea>
            </div><!--//form-group-->
            <div class="form-group">
                <label class="sr-only" for="scan-sum">Сумма</label>
                <input type="number" id="scan-sum" class="form-control" name="scan-sum" placeholder="Сумма"></input>
            </div><!--//form-group-->
            
            <div class='clearfix'></div>
    		<div id='progressbar'></div>
    	</div>
    	<form>
    		<input id='files' name='files' style='display: none'>
	    </form>
        <div class="form-group">
            <label class="file_upload">
                <button id="uploadbtn" class="button btn-cta-primary">выбрать</button>
                <mark>файл не выбран</mark>
            </label>
        </div><!--//form-group-->
      </div>
      <div class="modal-footer">
        <button type="button" class="close-popup btn btn-cta-secondary" data-dismiss="modal">Закрыть</button>
        <button id="new-file-btn" type="button" class="btn btn-cta-primary" onclick="addNewFile()">Подтвердить</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="newFolder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel2">Добавить новую папку</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group email">
            <label class="sr-only" for="newFolderName">Введите название папки</label>
            <input id="new-folder-name" name="newFolderName" maxlength="100" type="text" class="form-control login-email" placeholder="Введите название папки" required>
        </div><!--//form-group-->
        <h3>Дата (опционально)</h3>
        <div class="row">
            <div class="col-xs-6">
                <div class="form-group email">
                    <label class="sr-only" for="newFolderMonth">Введите номер месяца</label>
                    <input id="new-folder-month" name="newFolderMonth" max="12" type="number" class="form-control login-email" placeholder="Номер месяца" required>
                </div><!--//form-group-->
            </div>
            <div class="col-xs-6">
                <div class="form-group email">
                    <label class="sr-only" for="newFolderYear">Введите название года</label>
                    <input id="new-folder-year" name="newFolderYear" max="10000" type="number" class="form-control login-email" placeholder="Номер года" required>
                </div><!--//form-group-->
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="close-popup btn btn-cta-secondary" data-dismiss="modal">Закрыть</button>
        <button type="button" id="new-folder-btn" class="btn btn-cta-primary" onclick="addNewFolder()">Подтвердить</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="newObject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel3">Добавить новый объект</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group email">
            <label class="sr-only" for="newFolderName">Введите название объекта</label>
            <input id="new-object-name" name="newObjectName" maxlength="255" type="text" class="form-control login-email" placeholder="Введите название объекта" required>
        </div><!--//form-group-->
        <input type="text" id="new-object-user-id" style="display:none;">
      </div>
      <div class="modal-footer">
        <button type="button" class="close-popup btn btn-cta-secondary" data-dismiss="modal">Закрыть</button>
        <button type="button" id="new-folder-btn" class="btn btn-cta-primary" onclick="addNewObject()">Подтвердить</button>
      </div>
    </div>
  </div>
</div>
<div class="container">
				<div class="row item">
					<div class="content col-md-12 col-sm-12 col-xs-12">
						<section class="features-tabbed section" style="padding-bottom: 0;">
							<div class="container">
								<div class="row">
									<div class=" text-center col-md-12 col-sm-12 col-xs-12 col-md-offset-0 col-sm-offset-0 col-xs-offset-0">
										<!-- Nav tabs -->
										<ul class="nav nav-tabs text-center">
											<li class="active" onclick="getSummary()">
												<a data-toggle="tab" href="#feature-1" role="tab">
												<span class="">Сводка</span></a>
											</li>
											<li onclick="getPaymentScans()">
												<a data-toggle="tab" href="#feature-2" role="tab">
												<span class="">Сканы платежных документов</span></a>
											</li>
											<li onclick="getPhotoReports()">
												<a data-toggle="tab" href="#feature-3" role="tab">
												<span class="">Фотоотчеты</span></a>
											</li>
											<li onclick="getYourData()">
												<a data-toggle="tab" href="#feature-4" role="tab">
												<span class="">Ваши данные</span></a>
											</li>
										</ul><!--//nav-tabs-->
										<!-- Tab panes -->
										<div class="tab-content">
											<div class="tab-pane active" id="feature-1">
												<h3 class="title sr-only">Сводка</h3>
												<div class="desc text-left">
                                                    <div class="">
														<div class="row">
															<div class="content-area col-md-12 col-sm-12 col-xs-12" id="summary">
																
															</div><!--//content-area-->
														</div><!--//row-->
													</div><!--//container-->
												</div><!--//desc-->
											</div><!--//tab-pane-->
											<div class="tab-pane" id="feature-2">
												<h3 class="title sr-only">Сканы платежных документов</h3>
												<div class="desc text-left">
                                                    <div class="">
														<div class="row">
															<div class="content-area col-md-12 col-sm-12 col-xs-12" id="payment-scans">
																
															</div><!--//content-area-->
														</div><!--//row-->
													</div><!--//container-->
												</div><!--//desc-->
											</div><!--//tab-pane-->
											<div class="tab-pane" id="feature-3">
												<h3 class="title sr-only">Фотоотчеты</h3>
												<div class="desc text-left">
                                                    <div class="">
														<div class="row">
															<div class="content-area col-md-12 col-sm-12 col-xs-12" id="photo-reports">
																
															</div><!--//content-area-->
														</div><!--//row-->
													</div><!--//container-->
												</div><!--//desc-->
											</div><!--//tab-pane-->
											<div class="tab-pane" id="feature-4">
												<h3 class="title sr-only">Мобильное приложение</h3>
												<div class="desc text-left">
													<div class="">
														<div class="row">
															<div class="content-area col-md-12 col-sm-12 col-xs-12" id="your-data">
																
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
					</div><!--//content-->
				</div><!--//item-->
			</section>
		</div>
	</div>
</div>

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
    
</script>

<script>
    var toPrepUpBio = true;

    function prepareBiometryUpload(){
        if(toPrepUpBio) {
            if($("button").is("#upload-biometry")){
                $.ajaxUploadSettings.name = 'uploads[]';
                $('#upload-biometry').ajaxUploadPrompt({
                	url: '../public_html/php/upload_biometry.php',
                	error: function() {},
                	success: function(data) {
                		data = $.parseJSON(data);
                		$('#biometry-link').attr('href', 'public_html/ticket_files/'+data.id+'/'+data.vata);
                	}
                }); 
                toPrepUpBio = false;    
            } else {
                setTimeout(prepareBiometryUpload, 300);
            }
            
        }
    }
    
    window.onload = function(){$("#summary").empty();  getSummary()};
</script>
<script src="public_html/assets/js/jssor.slider-27.5.0.min.js" type="text/javascript"></script>
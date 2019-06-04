
let Renderer = class {
    constructor(userId, objectId, folderId, firstObject, objectName) {
        this.userId = userId;
        this.objectId = objectId;
        this.folderId = folderId;
        this.firstObject = firstObject;
        this.folderName = '';
        this.typeName = '';
        this.objectName = '';
        this.typeId = '';
    }
    
    get UserId() {
        return this.userId;
    }
    
    get TypeId() {
        return this.typeId;
    }
    
    get ObjectId() {
        return this.objectId;
    }
    
    get FolderId() {
        return this.folderId;
    }
    
    get FolderName() {
        return this.folderName;
    }
    
    get FirstObject() {
        return this.firstObject;
    }
    
    set setUserId(newValue) {
        this.userId = newValue;
    }
    
    set setObjectId(newValue) {
        this.objectId = newValue;
    }
    
    set setFolderId(newValue) {
        this.folderId = newValue;
    }
    
    set setFirstObject(newValue) {
        this.firstObject = newValue;
    }
    
    getObjectData(id) {
        let objectId = '';
        if(id){
            objectId = id;
            this.objectId = id;
        } else {
            objectId = this.objectId;
        }
        const userId = $("#ticket-box").attr('user-id');
        this.userId = userId;
            
        const fileTreeTemplate = $('#fileTreeTemplate').html();
        if(this.firstObject){
            Mustache.parse(fileTreeTemplate);
            this.fileTreeTemplate = fileTreeTemplate;
        }
        this.objectName = $("#objct" + objectId + " a").html();
        const treeData = {
            object: true,
            objectId,
            objectName: this.objectName
        };
        const renderedFileTreeTemplate = Mustache.render(fileTreeTemplate, treeData);
        
        const folderTreeTemplate = $('#folderTreeTemplate').html();
        if(this.firstObject){
            Mustache.parse(folderTreeTemplate);
            this.folderTreeTemplate = folderTreeTemplate;
        }
        const folderTreeData = {
            tree: renderedFileTreeTemplate,
            userId,
            userName: $("#user"+userId).html()
        };
        const renderedFolderTreeTemplate = Mustache.render(folderTreeTemplate, folderTreeData);
        
        const fileSystemContentTemplate = $('#fileSystemContentTemplate').html();
        if(this.firstObject){
            Mustache.parse(fileSystemContentTemplate);
            this.fileSystemContentTemplate = fileSystemContentTemplate;
        }
        let folders = [];
        folders[0] = {
            folderId: "'Svod'",
            folderName: "Сводка"
        };
        folders[1] = {
            folderId: "'Scan'",
            folderName: "Сканы"
        };
        folders[2] = {
            folderId: "'Photo'",
            folderName: "Фото"
        };
        const fileSystemContentData = {
            folders
        };
        const renderedFileSystemContentTemplate = Mustache.render(fileSystemContentTemplate, fileSystemContentData);
        
        const fileSystemTemplate = $('#fileSystemTemplate').html();
        if(this.firstObject){
            Mustache.parse(fileSystemTemplate);
            this.fileSystemTemplate = fileSystemTemplate;
        }
        const fileSystemData = {
            userId,
            objectId,
            content: renderedFileSystemContentTemplate
        };
        const renderedFileSystemTemplate = Mustache.render(fileSystemTemplate, fileSystemData);
        
        const data = {
            folderTree: renderedFolderTreeTemplate,
            fileData: renderedFileSystemTemplate
        };
        const adminTemplate = $('#adminTemplate').html();
        if(this.firstObject){
            Mustache.parse(adminTemplate);
            this.firstObject = false;
            this.adminTemplate = adminTemplate;
        }
        const renderedAdminTemplate = Mustache.render(adminTemplate, data);
        $('#message-box .desc').html(renderedAdminTemplate);
    }
    
    openFolder(content, typeId, folderName, isArend){
        if(content !== false) {
            content.editableName = true;
        }
        let fileTreeTemplate;
        if(this.fileTreeTemplate === undefined) {
            fileTreeTemplate = $('#fileTreeTemplate').html();
        } else {
            fileTreeTemplate = this.fileTreeTemplate;
        }
        let typeName = '';
        if(typeId !== undefined){
            this.typeId = typeId;
            switch(typeId) {
                case 0:
                    typeName = 'Сводка';
                    typeId = '"Svod"';
                    break;
                case 1:
                    typeName = 'Сканы';
                    typeId = '"Scan"';
                    break;
                case 2:
                    typeName = 'Фото';
                    typeId = '"Photo"';
                    break;
            }
        }
        let tree = [];
        if(typeId !== undefined){
            tree[0] = {
                folderId: typeId,
                folderName: typeName
            }
        }
        if(folderName !== undefined){
            tree[1] = {
                folderId: -1,
                folderName
            }
        }
        const treeData = {
            object: true,
            objectId: this.objectId,
            objectName: this.objectName,
            tree,
            isArend
        };
        if(this.objectId === false){
            treeData.object = false;
        } 
        const renderedFileTreeTemplate = Mustache.render(fileTreeTemplate, treeData);
        
        let fileSystemContentTemplate;
        if(this.fileSystemContentTemplate === undefined) {
            fileSystemContentTemplate = $('#fileSystemContentTemplate').html();   
        } else {
            fileSystemContentTemplate = this.fileSystemContentTemplate;
        }
        let renderedFileSystemContentTemplate;
        if(content !== false){
            renderedFileSystemContentTemplate = Mustache.render(fileSystemContentTemplate, content);
        } else {
            renderedFileSystemContentTemplate = '';
        }
        
        
        $("#folder-tree-content").html(renderedFileTreeTemplate);
        $("#file-system").html(renderedFileSystemContentTemplate);
    }
    
    getUserInfo(data){
        let userInfoTemplate;
        if(this.userInfoTemplate === undefined) {
            userInfoTemplate = $('#userInfoTemplate').html();
        } else {
            userInfoTemplate = this.userInfoTemplate;
        }
        const renderedUserInfoTemplate = Mustache.render(userInfoTemplate, data);
        $("#user-info").html(renderedUserInfoTemplate);
        prepareBiometryUpload();
    }
    
    getAdminInfo(data){
        let adminInfoTemplate;
        if(this.adminInfoTemplate === undefined) {
            adminInfoTemplate = $('#adminInfoTemplate').html();
        } else {
            adminInfoTemplate = this.adminInfoTemplate;
        }
        const renderedAdminInfoTemplate = Mustache.render(adminInfoTemplate, data);
        $("#admin-info").html(renderedAdminInfoTemplate);
    }
    
    getOtherFunctions(){
        let otherFunctionsTemplate;
        if(this.otherFunctionsTemplate === undefined) {
            otherFunctionsTemplate = $('#otherFunctionsTemplate').html();
        } else {
            otherFunctionsTemplate = this.otherFunctionsTemplate;
        }
        const renderedOtherFunctionsTemplate = Mustache.render(otherFunctionsTemplate, {});
        $("#other-functions").html(renderedOtherFunctionsTemplate);
    }
    
    openObjectNews(data){
        let objectNewsTemplate;
        if(this.objectNewsTemplate === undefined) {
            objectNewsTemplate = $('#objectNewsTemplate').html();
        } else {
            objectNewsTemplate = this.objectNewsTemplate;
        }
        const renderedObjectNewsTemplate = Mustache.render(objectNewsTemplate, data);
        $("#other-functions").html(renderedObjectNewsTemplate);
    }
}

let newRenderer = new Renderer(0, 0, 0, true);

function openFolder(id){
    switch(id){
        case 'Svod':
            openMainFolder(0);
            break;
        case 'Scan':
            openMainFolder(1);
            break;
        case 'Photo':
            openMainFolder(2);
            break;
        case -1: 
            break;
        default:
            getFiles(id)
    }
}

var toPrepUp = true;
var toPrepUpBio = true;

function prepareUpload(){
    if(toPrepUp){
        const userId = newRenderer.UserId;
        $.ajaxUploadSettings.name = 'uploads[]';
        $('#uploadbtn').ajaxUploadPrompt({
        	url: '../public_html/php/upload.php?user_id='+userId,
        	onprogress: function(e) {
        		if (e.lengthComputable) {
        			var percentComplete = e.loaded / e.total;
        			$('#progressbar').progressbar({
        				value: percentComplete * 100,
        				complete: function() {
        					$(this).progressbar('destroy');
        				}
        			});
        		}
        	},
        	error: function() {},
        	success: function(data) {
        		data = $.parseJSON(data);
        		$(".file_upload mark").html(data.vata);
        		$('#files').val($('#files').val() + data.vata);
        		$('#new-file-wrapper').append('<div id=\"progressbar\"><\/div>');
        	}
        }); 
        toPrepUp = false;
    }
   
}

function prepareBiometryUpload(){
    if(toPrepUpBio) {
        if($("button").is("#upload-biometry")){
            const userId = newRenderer.UserId;
            $.ajaxUploadSettings.name = 'uploads[]';
            $('#upload-biometry').ajaxUploadPrompt({
            	url: '../public_html/php/upload_biometry.php?user_id='+userId,
            	error: function() {},
            	success: function(data) {
            		data = $.parseJSON(data);
            		$('#biometry-link').attr('href', 'public_html/ticket_files/'+userId+'/'+data.vata);
            	}
            }); 
            toPrepUpBio = false;    
        } else {
            setTimeout(prepareBiometryUpload, 300);
        }
        
    }
    
}

function openNewObjectModal(user_id){
    $("#newObject").modal("toggle");
    $("#new-object-user-id").val(user_id);
}

function editNews(id){
    const textareacontent = br2nl($("#news-"+id+" .news-text-wrapper p").html());
    const textarea2out = '<textarea class="form-control" rows="5" placeholder="Введите текст новости">'+textareacontent+'</textarea>';
    const datecontent = $("#news-"+id+" .news-date-wrapper").html();
    const datecontent2out = '<input type="text" value="'+datecontent+'" class="form-control" style="max-width: 200px;"/>';
    $("#news-" + id + " .news-text-wrapper").html(textarea2out);
    $("#news-" + id + " .news-date-wrapper").html(datecontent2out);
    const button = $("#news-" + id + " .float-right");
    button.attr("onclick", "updateNews(" + id + ")");
    button.html("Подтвердить");
}

function changeFolderName(id){
    const value = $("#folder-" + id + "-name").html();
    const output = '<input type="text" value="'+value+'"> <a onclick="updateFolderName('+id+')"><i class="fas fa-check"></i></a> <a onclick="declineUpdatingFolderName('+id+', \''+value+'\')"><i class="fas fa-times"></i></a>';
    $("#folder-" + id + "-name").parent(".file-link").removeAttr("onclick");
    $("#folder-" + id + "-name").html(output);
    $("#folder-" + id + "-name").addClass("on-edit");
}

function declineUpdatingFolderName(id, value){
    $("#folder-" + id + "-name").html(value);
    $("#folder-" + id + "-name").removeClass("on-edit");
    setTimeout(() => {$("#folder-" + id + "-name").parent(".file-link").attr("onclick", "openFolder(" + id + ")")}, 300);
}

function changeAdminParam(param, value){
    let output;
    if(value !== undefined){
        output = '<input type="text" class="form-control" value="'+value+'"> <a onclick="updateAdminParam(\''+param+'\')"><i class="fas fa-check"></i></a> <a onclick="declineUpdatingAdminParam(\''+param+'\', \''+value+'\')"><i class="fas fa-times"></i></a>';
    } else {
        output = '<input type="text" class="form-control" placeholder="Введите пароль"> <a onclick="updateAdminParam(\''+param+'\')"><i class="fas fa-check"></i></a> <a onclick="declineUpdatingAdminParam(\''+param+'\')"><i class="fas fa-times"></i></a>';
    }
    
    $("#admin-" + param).html(output);
}

function declineUpdatingAdminParam(param, value){
    let output;
    if(value !== undefined){
        output = value + ' <a onclick="changeAdminParam(\'' + param + '\', \'' + value + '\')"><i class="fas fa-edit"></i></a>';
    } else {
        output = '******** <a onclick="changeAdminParam(\'password\')"><i class="fas fa-edit"></i></a>';
    }
    $("#admin-" + param).html(output);
}

function changeOrderNumbers(id, tableId) {
    const inputs = $("#"+tableId+" input");
    const nelem = inputs.length;
    let numarr = [];
    for(let i = 0; i < nelem+1; i++) {
        numarr[i] = 0;
    }
    numarr[0] = 1;
    let constnum;
    let constindex;
    inputs.each((index, elem) => {
        if($(elem).attr("folder-id") == id) {
            constnum = $(elem).val();
            constindex = index;
        }
        numarr[$(elem).val()] = 1;
    });
    console.log(numarr);
    for(let i = 1; i < nelem + 1; i++) {
        if(i == constnum) {
            let counter = 0;
            let increment = 1;
            inputs.each((index, elem) => {
                if($(elem).val() < 1 || $(elem).val() > nelem){
                    $(elem).val(1);
                }
                if(($(elem).val() == i)) {
                    if(index == constindex) {
                        if(counter > 0) {
                            let subcounter = 1;
                            let subincrement = 1;
                            inputs.each((subindex, subelem) => {
                                if( $(subelem).val() == constnum && subindex != constindex) {
                                    if(subcounter > 0) {
                                        const retarr = findcurval(subelem, numarr, subincrement, nelem);
                                        const curval = retarr[0];
                                        subincrement = retarr[1];
                                        
                                        numarr[parseInt($(subelem).val(), 10)] = 0;
                                        numarr[curval] = 1;
                                        $(subelem).val(curval);
                                    } 
                                    subcounter++;
                                }
                            });
                        } else {
                            counter++;
                        }
                    } else {
                        if(counter > 0) {
                            const retarr = findcurval(elem, numarr, increment, nelem);
                            const curval = retarr[0];
                            increment = retarr[1];
                            
                            numarr[parseInt($(elem).val(), 10)] = 0;
                            numarr[curval] = 1;
                            $(elem).val(curval);
                        } 
                        counter++;
                    }
                }
            });
        } else {
            let counter = 0;
            let increment = 1;
            inputs.each((index, elem) => {
                if($(elem).val() < 1 || $(elem).val() > nelem){
                    $(elem).val(1);
                }
                if(($(elem).val() == i)) {
                    if(counter > 0) {
                        const retarr = findcurval(elem, numarr, increment, nelem);
                        const curval = retarr[0];
                        increment = retarr[1];
                        
                        numarr[parseInt($(elem).val(), 10)] = 0;
                        numarr[curval] = 1;
                        $(elem).val(curval);
                    } 
                    counter++;
                }
            });
        }
    }
    console.log(numarr);
}

function findcurval(elem, numarr, increment, nelem) {
    let curval;
    if(parseInt($(elem).val(), 10) + increment > nelem){
        let test = numarr.find((element) => {
            return element == 0;
        });
        if(typeof test === undefined) {
            curval = 1;
        } else {
            curval = test;
        }
        numarr[curval] = 1;
    } else {
        curval = parseInt($(elem).val(), 10) + increment++;
        numarr[curval] = 1;
    }
    return [curval, increment];
}

function br2nl(str) {
    return str.replace(/<br\s*\/?>/mg,"\n");
}
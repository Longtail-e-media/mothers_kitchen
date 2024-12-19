<link href="<?php echo ASSETS_PATH; ?>uploadify/uploadify.css" rel="stylesheet" type="text/css"/>
<?php
$moduleTablename = "tbl_services"; // Database table name
$moduleId = 20;                // module id >>>>> tbl_modules

if (isset($_GET['page']) && $_GET['page'] == "services" && isset($_GET['mode']) && $_GET['mode'] == "list"):
// clearImages($moduleTablename, "services");
// clearImages($moduleTablename, "services/thumbnails");

    SerclearImages($moduleTablename, "services");
    SerclearImages($moduleTablename, "services/thumbnails");

    ?>
    <h3>
        List Services
        <a class="loadingbar-demo btn medium bg-blue-alt float-right" href="javascript:void(0);"
           onClick="AddNewServices();">
    <span class="glyph-icon icon-separator">
    	<i class="glyph-icon icon-plus-square"></i>
    </span>
            <span class="button-content"> Add New </span>
        </a>
    </h3>
    <div class="my-msg"></div>
    <div class="example-box">
        <div class="example-code">
            <table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
                <thead>
                <tr>
                    <th style="display:none;"></th>
                    <th class="text-center"><input class="check-all" type="checkbox"/></th>
                    <th>Title</th>
                    <th class="text-center"><?php echo $GLOBALS['basic']['action']; ?></th>
                </tr>
                </thead>

                <tbody>
                <?php $records = Services::find_by_sql("SELECT * FROM " . $moduleTablename . " ORDER BY sortorder DESC ");
                foreach ($records as $key => $record): ?>
                    <tr id="<?php echo $record->id; ?>">
                        <td style="display:none;"><?php echo $key + 1; ?></td>
                        <td><input type="checkbox" class="bulkCheckbox" bulkId="<?php echo $record->id; ?>"/></td>
                        <td>
                            <div class="col-md-7">
                                <a href="javascript:void(0);" onClick="editRecord(<?php echo $record->id; ?>);"
                                   class="loadingbar-demo"
                                   title="<?php echo $record->title; ?>"><?php echo $record->title; ?></a>
                            </div>
                        </td>
                        <td class="text-center">
                            <?php
                            $statusImage = ($record->status == 1) ? "bg-green" : "bg-red";
                            $statusText = ($record->status == 1) ? $GLOBALS['basic']['clickUnpub'] : $GLOBALS['basic']['clickPub'];
                            ?>
                            <a href="javascript:void(0);"
                               class="btn small <?php echo $statusImage; ?> tooltip-button statusToggler"
                               data-placement="top" title="<?php echo $statusText; ?>"
                               status="<?php echo $record->status; ?>" id="imgHolder_<?php echo $record->id; ?>"
                               moduleId="<?php echo $record->id; ?>">
                                <i class="glyph-icon icon-flag"></i>
                            </a>
                            <a href="javascript:void(0);" class="loadingbar-demo btn small bg-blue-alt tooltip-button"
                               data-placement="top" title="Edit" onclick="editRecord(<?php echo $record->id; ?>);">
                                <i class="glyph-icon icon-edit"></i>
                            </a>
                            <a href="javascript:void(0);" class="btn small bg-red tooltip-button" data-placement="top"
                               title="Remove" onclick="recordDelete(<?php echo $record->id; ?>);">
                                <i class="glyph-icon icon-remove"></i>
                            </a>
                            <input name="sortId" type="hidden" value="<?php echo $record->id; ?>">
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="pad0L col-md-2">
            <select name="dropdown" id="groupTaskField" class="custom-select">
                <option value="0"><?php echo $GLOBALS['basic']['choseAction']; ?></option>
                <option value="delete"><?php echo $GLOBALS['basic']['delete']; ?></option>
                <option value="toggleStatus"><?php echo $GLOBALS['basic']['toggleStatus']; ?></option>
            </select>
        </div>
        <a class="btn medium primary-bg" href="javascript:void(0);" id="applySelected_btn">
        <span class="glyph-icon icon-separator float-right">
          <i class="glyph-icon icon-cog"></i>
        </span>
            <span class="button-content"> Click </span>
        </a>
    </div>

<?php elseif (isset($_GET['mode']) && $_GET['mode'] == "addEdit"):
    if (isset($_GET['id']) && !empty($_GET['id'])):
        $advId = addslashes($_REQUEST['id']);
        $advInfo = Services::find_by_id($advId);
        $status = ($advInfo->status == 1) ? "checked" : " ";
        $unstatus = ($advInfo->status == 0) ? "checked" : " ";
    endif;
    ?>
    <h3>
        <?php echo (isset($_GET['id'])) ? 'Edit Services' : 'Add Services'; ?>
        <a class="loadingbar-demo btn medium bg-blue-alt float-right" href="javascript:void(0);"
           onClick="viewServiceslist();">
    <span class="glyph-icon icon-separator">
    	<i class="glyph-icon icon-arrow-circle-left"></i>
    </span>
            <span class="button-content"> Back </span>
        </a>
    </h3>

    <div class="my-msg"></div>
    <div class="example-box">
        <div class="example-code">
            <form action="" class="col-md-12 center-margin" id="services_frm">
                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            Title :
                        </label>
                    </div>
                    <div class="form-input col-md-8">
                        <input placeholder="Services Title" class="col-md-6 validate[required,length[0,50]]" type="text"
                               name="title" id="title"
                               value="<?php echo !empty($advInfo->title) ? $advInfo->title : ""; ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            Sub Title :
                        </label>
                    </div>
                    <div class="form-input col-md-8">
                        <input placeholder="Sub Title" class="col-md-6 validate" type="text" name="sub_title"
                               id="sub_title"
                               value="<?php echo !empty($advInfo->sub_title) ? $advInfo->sub_title : ""; ?>">
                    </div>
                </div>
                <div class="form-row add-image">
                    <div class="form-label col-md-2">
                        <label for="">
                            Image :
                        </label>
                    </div>
                    <div class="form-input col-md-10 uploader">
                        <input type="file" name="gallery_upload" id="gallery_upload" class="transparent no-shadow">
                        <label>
                        <small>Image Dimensions (<?php echo Module::get_properties($moduleId, 'imgwidth'); ?> px
                            X <?php echo Module::get_properties($moduleId, 'imgheight'); ?> px)
                        </small>
                    </label>
                    </div>
                    <!-- Upload user image preview -->
                    <div id="preview_Image"><input type="hidden" name="imageArrayname[]"/></div>
                    <?php
                    if (!empty($advInfo->image)) {
                        $imgRec = unserialize($advInfo->image);
                        if (is_array($imgRec)) {
                            foreach ($imgRec as $key => $recimg) {
                                $deleteid = rand(0, 99999);
                                $imagePath = SITE_ROOT . 'images/services/' . $recimg;
                                if (file_exists($imagePath)) { ?>
                                    <div class="col-md-3" id="removeSavedimg<?php echo $deleteid; ?>">
                                        <div class="infobox info-bg">
                                            <div class="button-group" data-toggle="buttons">
                            <span class="float-left">
                                <?php
                                if (file_exists(SITE_ROOT . "images/services/" . $recimg)):
                                    $filesize = filesize(SITE_ROOT . "images/services/" . $recimg);
                                    echo 'Size : ' . getFileFormattedSize($filesize);
                                endif;
                                ?>
                            </span>
                                                <a class="btn small float-right" href="javascript:void(0);"
                                                   onclick="deleteSavedServicesimage(<?php echo $deleteid; ?>);">
                                                    <i class="glyph-icon icon-trash-o"></i>
                                                </a>
                                            </div>
                                            <img src="<?php echo IMAGE_PATH . 'services/thumbnails/' . $recimg; ?>"
                                                 style="width:100%"/>
                                            <input type="hidden" name="imageArrayname[]" value="<?php echo $recimg; ?>"
                                                   class="validate[required,length[0,250]]"/>
                                        </div>
                                    </div>
                                <?php }
                            }
                        }
                    } ?>
                </div>

                <div class="form-row">
                <div class="form-label col-md-2">
                    <label for="">
                        Icon Image :
                    </label>
                </div>

                <?php if (!empty($advInfo->icon_image)): ?>
                    <div class="col-md-2" id="removeSavedimg11">
                        <div class="infobox info-bg">
                            <div class="button-group" data-toggle="buttons">
                            <span class="float-left">
                                <?php
                                if (file_exists(SITE_ROOT . "images/services/icon/" . $advInfo->icon_image)):
                                    $filesize = filesize(SITE_ROOT . "images/services/icon/" . $advInfo->icon_image);
                                    echo 'Size : ' . getFileFormattedSize($filesize);
                                endif;
                                ?>
                            </span>
                                <a class="btn small float-right" href="javascript:void(0);"
                                   onclick="deleteSavedServicesimage(11);">
                                    <i class="glyph-icon icon-trash-o"></i>
                                </a>
                            </div>
                            <img src="<?php echo IMAGE_PATH . 'services/icon/thumbnails/' . $advInfo->icon_image; ?>"
                                 style="width:100%"/>
                            <input type="hidden" name="imageArrayname11"
                                   value="<?php echo $advInfo->icon_image; ?>"/>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="form-input col-md-10 uploader11 <?php echo !empty($advInfo->icon_image) ? "hide" : ""; ?>">
                    <input type="file" name="icon_image" id="icon_image" class="transparent no-shadow">
                    <!-- <label>
                        <small>Image Dimensions (<?php echo Module::get_properties($moduleId, 'cimgwidth'); ?> px
                            X <?php echo Module::get_properties($moduleId, 'cimgheight'); ?> px)
                        </small>
                    </label> -->
                </div>
                <!-- Upload user image preview -->
                <div id="preview_Image11"></div>
            </div>

                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            Icon :
                        </label>
                    </div>
                    <div class="form-input col-md-8">
                        <input placeholder="e.g. fas fa-wifi" class="col-md-6" type="text" name="icon" id="icon"
                               value="<?php echo !empty($advInfo->icon) ? $advInfo->icon : ""; ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label col-md-8">
                        <label for="">
                            Content :
                        </label>
                        <textarea name="content" id="content"
                                  class="large-textarea"><?php echo !empty($advInfo->content) ? $advInfo->content : ""; ?></textarea>
                        <a class="btn medium bg-orange mrg5T" title="Read More" id="readMore"
                           href="javascript:void(0);">
                            <span class="button-content">Read More</span>
                        </a>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label col-md-2">
                        <label for="">
                            Status :
                        </label>
                    </div>
                    <div class="form-checkbox-radio col-md-9">
                        <input type="radio" class="custom-radio" name="status" id="check1"
                               value="1" <?php echo !empty($status) ? $status : "checked"; ?>>
                        <label for="">Published</label>
                        <input type="radio" class="custom-radio" name="status" id="check0"
                               value="0" <?php echo !empty($unstatus) ? $unstatus : ""; ?>>
                        <label for="">Un-Published</label>
                    </div>
                </div>
                <button btn-action='0' type="submit" name="submit"
                        class="btn-submit btn large primary-bg text-transform-upr font-bold font-size-11 radius-all-4"
                        id="btn-submit" title="Save">
                <span class="button-content">
                    Save
                </span>
                </button>
                <button btn-action='1' type="submit" name="submit"
                        class="btn-submit btn large primary-bg text-transform-upr font-bold font-size-11 radius-all-4"
                        id="btn-submit" title="Save">
                <span class="button-content">
                    Save & More
                </span>
                </button>
                <button btn-action='2' type="submit" name="submit"
                        class="btn-submit btn large primary-bg text-transform-upr font-bold font-size-11 radius-all-4"
                        id="btn-submit" title="Save">
                <span class="button-content">
                    Save & quit
                </span>
                </button>
                <input myaction='0' type="hidden" name="idValue" id="idValue"
                       value="<?php echo !empty($advInfo->id) ? $advInfo->id : 0; ?>"/>
            </form>
        </div>
    </div>

    <script type="text/javascript" src="<?php echo ASSETS_PATH; ?>uploadify/jquery.uploadify.min.js"></script>
    <script>
        var base_url = "<?php echo ASSETS_PATH; ?>";
        var editor_arr = ["content"];
        create_editor(base_url, editor_arr);
    </script>
    <script type="text/javascript">
        // <![CDATA[
        $(document).ready(function () {
            $('#gallery_upload').uploadify({
                'swf': '<?php echo ASSETS_PATH;?>uploadify/uploadify.swf',
                'uploader': '<?php echo ASSETS_PATH;?>uploadify/uploadify.php',
                'formData': {
                    PROJECT: '<?php echo SITE_FOLDER;?>',
                    targetFolder: 'images/services/',
                    thumb_width: 200,
                    thumb_height: 200
                },
                'method': 'post',
                'cancelImg': '<?php echo BASE_URL;?>uploadify/cancel.png',
                'auto': true,
                'multi': true,
                'hideButton': false,
                'buttonText': 'Upload Image',
                'width': 125,
                'height': 21,
                'removeCompleted': true,
                'progressData': 'speed',
                'uploadLimit': 100,
                'fileTypeExts': '*.gif; *.jpg; *.jpeg;  *.png; *.GIF; *.JPG; *.JPEG; *.PNG;',
                'buttonClass': 'button formButtons',
                /* 'checkExisting' : '/uploadify/check-exists.php',*/
                'onUploadSuccess': function (file, data, response) {
                    $('#uploadedImageName').val('1');
                    var filename = data;
                    $.post('<?php echo BASE_URL;?>apanel/services/uploaded_image.php', {imagefile: filename}, function (msg) {
                        $('#preview_Image').append(msg).show();
                    });

                },
                'onDialogOpen': function (event, ID, fileObj) {
                },
                'onUploadError': function (file, errorCode, errorMsg, errorString) {
                    alert(errorMsg);
                },
                'onUploadComplete': function (file) {
                    //alert('The file ' + file.name + ' was successfully uploaded');
                }
            });


            $('#icon_image').uploadify({
                'swf': '<?php echo ASSETS_PATH;?>uploadify/uploadify.swf',
                'uploader': '<?php echo ASSETS_PATH;?>uploadify/uploadify.php',
                'formData': {
                    PROJECT: '<?php echo SITE_FOLDER;?>',
                    targetFolder: 'images/services/icon/',
                    thumb_width: 200,
                    thumb_height: 200
                },
                'method': 'post',
                'cancelImg': '<?php echo BASE_URL;?>uploadify/cancel.png',
                'auto': true,
                'multi': true,
                'hideButton': false,
                'buttonText': 'Upload Image',
                'width': 125,
                'height': 21,
                'removeCompleted': true,
                'progressData': 'speed',
                'uploadLimit': 100,
                'fileTypeExts': '*.gif; *.jpg; *.jpeg;  *.png; *.GIF; *.JPG; *.JPEG; *.PNG;',
                'buttonClass': 'button formButtons',
                /* 'checkExisting' : '/uploadify/check-exists.php',*/
                'onUploadSuccess': function (file, data, response) {
                    $('#uploadedImageName').val('1');
                    var filename = data;
                    $.post('<?php echo BASE_URL;?>apanel/services/uploaded_image11.php', {imagefile: filename}, function (msg) {
                        $('#preview_Image11').append(msg).show();
                    });

                },
                'onDialogOpen': function (event, ID, fileObj) {
                },
                'onUploadError': function (file, errorCode, errorMsg, errorString) {
                    alert(errorMsg);
                },
                'onUploadComplete': function (file) {
                    //alert('The file ' + file.name + ' was successfully uploaded');
                }
            });
        });
        // ]]>
    </script>
    <script>
        $(document).ready(function () {
            /************************************ Editor for message *****************************************/
            var base_url = "<?php echo ASSETS_PATH; ?>";
            CKEDITOR.replace('content', {
                toolbar:
                    [
                        {
                            name: 'document',
                            items: ['Source', '-', 'Save', 'NewPage', 'DocProps', 'Preview', 'Print', '-', 'Templates']
                        },
                        {name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize']}, '/',
                        {name: 'colors', items: ['TextColor', 'BGColor']},
                        {name: 'tools', items: ['Maximize', 'ShowBlocks', '-', 'About']}
                    ]
            });
        });
    </script>
<?php endif; ?>
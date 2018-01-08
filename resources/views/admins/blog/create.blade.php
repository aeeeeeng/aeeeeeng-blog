@extends('admins.layouts.admin')
@section('title')
  Blog Management
@stop
@section('css')
  <style media="screen">
  .not-active {
    pointer-events: none;
    cursor: default;
  }

  #preview{
    margin-top: 15px;
    border: 1px solid #e65959;
    padding: 5px;
  }
  </style>
@stop
@section('content')
  <div class="main-content">
    <div class="card">
      <h4 class="card-title">Blog Management</h4>
      <div class="card-body">
        <div class="row">
          <div class="col-lg-12">
            {!! Form::open(["action"=>"Admin\BlogController@store", "method"=>"post", "files"=>true]) !!}
            <ul class="nav nav-process nav-process-lg nav-process-danger nav-process-block setup-panel">
              <li class="nav-item complete">
                <a class="nav-link" href="#step-1">
                  <span class="nav-link-number">1</span>
                  <div class="nav-link-body">
                    <span class="nav-title">Head Content</span>
                    <span>Title Category Poster Video File</span>
                  </div>
                </a>
              </li>

              <li class="nav-item ">
                <a class="nav-link dis" href="#step-2">
                  <span class="nav-link-number">2</span>
                  <div class="nav-link-body">
                    <span class="nav-title">Body Content</span>
                    <span>Content Idea</span>
                  </div>
                </a>
              </li>

              <li class="nav-item ">
                <a class="nav-link dis" href="#step-3">
                  <span class="nav-link-number">3</span>
                  <div class="nav-link-body">
                    <span class="nav-title">Meta Data</span>
                    <span>Description & Keywords</span>
                  </div>
                </a>
              </li>
            </ul>

            <div id="step-1" class="setup-content">
              <div class="col-lg-6" style="float:none; margin: 0 auto;">
                <div class="form-group">
                  <label>Blog Title</label>
                  {{Form::text("blog_title", null, ["class"=>($errors->has("blog_title")) ? "form-control is-invalid" : "form-control", "id"=>"blog_title"])}}
                  {!!  ($errors->has('blog_title')) ? '<div class="invalid-feedback">'.$errors->first('blog_title').'</div>' : '' !!}
                </div>
                <div class="form-group">
                  <label>Category</label>
                  {{Form::select("cat_id", $category, null, ["data-provide"=>"selectpicker", "data-live-search"=>"true", "class"=>($errors->has("cat_id")) ? "form-control is-invalid" : "form-control", "id"=>"cat_id", "placeholder"=>"chose category.."])}}
                  {!!  ($errors->has('cat_id')) ? '<div class="invalid-feedback">'.$errors->first('cat_id').'</div>' : '' !!}
                </div>
                <div class="file-group file-group-inline " style="border: 0px;">
                  <button class="btn btn-info file-browser " type="button">Upload Poster</button>
                  {{Form::file("blog_image_poster", ["id"=>"blog_image_poster", "accept"=>"image/*"])}}
                  {!!  ($errors->has('blog_image_poster')) ? '<div class="invalid-feedback">'.$errors->first('blog_image_poster').'</div>' : '' !!}
                </div>
                <div id="img-display"></div>
                <div class="form-group file-group">
                  <label>Upload Pdf File</label>
                  <input type="text" class="form-control {{($errors->has("blog_pdf_file_embed")) ? "is-invalid" : null}} file-value file-browser" placeholder="Choose file..." readonly="">
                  {{Form::file("blog_pdf_file_embed", ["id"=>"blog_pdf_file_embed", "accept"=>"application/pdf", "multiple"=>""])}}
                </div>
                <div class="form-group">
                  <label>Blog Video Embed</label>
                  {{Form::text("blog_video_embed", null, ["class"=>($errors->has("blog_video_embed")) ? "form-control is-invalid" : "form-control", "id"=>"blog_video_embed"])}}
                  {!!  ($errors->has('blog_video_embed')) ? '<div class="invalid-feedback">'.$errors->first('blog_video_embed').'</div>' : '' !!}
                </div>
              </div>
            </div>
            <div id="step-2" class="setup-content">
              {{Form::textarea("blog_content", null, ["id"=>"editor1", "rows"=>"8", "cols"=>"80"])}}
              {!!  ($errors->has('blog_content')) ? '<div class="invalid-feedback">'.$errors->first('blog_content').'</div>' : '' !!}
              <h4 style="text-align:center; margin-top:15px;">Live Display</h4>
              <div id="preview"></div>
            </div>
            <div id="step-3" class="setup-content ">
              <div class="col-lg-6" style="float:none; margin: 0 auto;">
              <div class="form-group">
                <label>Meta Description</label>
                {{Form::textarea("blog_meta_desc", null, ["class"=>($errors->has("blog_meta_desc")) ? "form-control is-invalid" : "form-control", "id"=>"blog_meta_desc"])}}
                {!!  ($errors->has('blog_meta_desc')) ? '<div class="invalid-feedback">'.$errors->first('blog_meta_desc').'</div>' : '' !!}
              </div>
              <div class="form-group">
                <label>Meta Keywords</label>
                {{Form::text("blog_meta_key", null, ["data-provide"=>"tagsinput", "class"=>($errors->has("blog_meta_key")) ? "form-control is-invalid" : ""])}}
                {!!  ($errors->has('blog_meta_key')) ? '<div class="invalid-feedback">'.$errors->first('blog_meta_key').'</div>' : '' !!}
              </div>

            </div>
            <button type="submit" class="btn btn-label btn-danger pull-right" style="margin-left:10px; margin-bottom:10px;">
              <label><i class="fa fa-save"></i></label>
              Publish
            </button>
            <button type="submit" class="btn btn-label btn-primary pull-right" name="isdraft" style="margin-left:10px; margin-bottom:10px;">
              <label><i class="fa fa-save"></i></label>
              Save to Draft
            </button>
            <a href="/admin03061993/blog" class="btn btn-label btn-secondary pull-right" style="margin-bottom:10px;">
              <label><i class="fa fa-arrow-left"></i></label>
              Back
            </a>
            </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
@endsection
@section('js')
    <script src="/templateEditor/ckeditor/ckeditor.js" charset="utf-8"></script>
    <script type="text/javascript">
      var editor = CKEDITOR.replace( 'editor1' ,{
        on: {
						change: syncPreview,
					}
      });
      var preview = CKEDITOR.document.getById( 'preview' );
      function syncPreview() {
				preview.setHtml( editor.getData() );
			}
      CKEDITOR.on('instanceReady', function () {
				$.each(CKEDITOR.instances, function (instance) {
					CKEDITOR.instances[instance].document.on("keyup", CK_jQ);
					CKEDITOR.instances[instance].document.on("paste", CK_jQ);
					CKEDITOR.instances[instance].document.on("keypress", CK_jQ);
					CKEDITOR.instances[instance].document.on("blur", CK_jQ);
					CKEDITOR.instances[instance].document.on("change", CK_jQ);
				});
			});
      function CK_jQ() {
				for (instance in CKEDITOR.instances) {
					CKEDITOR.instances[instance].updateElement();
				}
			}

      var navListItems = $('ul.setup-panel li a'),
				allWells = $('.setup-content');

			allWells.hide();

			navListItems.click(function(e)
			{
				e.preventDefault();
				var $target = $($(this).attr('href')),
					$item = $(this).closest('li');

				if (!$item.hasClass('dis')) {
					navListItems.closest('li').removeClass('complete');
					$item.addClass('complete');
					allWells.hide();
					$target.show();
				}
			});

			$('ul.setup-panel li.complete a').trigger('click');

      $("#blog_image_poster").on("change", function(){
        readURL(this);
      });

      function readURL(input){
        if (input.files && input.files[0]){
        var reader = new FileReader();

        reader.onload = function(e){
          $("#img-display").html("<img src='"+e.target.result+"' style='width:132px;'>");
        }
        reader.readAsDataURL(input.files[0]);
        }
      }
    </script>
@stop

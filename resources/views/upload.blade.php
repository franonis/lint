@extends('layouts.app')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('/layui/dist/css/layui.css') }}"  media="all">

@endsection
@section('navbar')
  @include('partials.navbar')
@endsection
@section('content')
<div class="container content">
    <div class="row">
        @include('partials.errors')
        <h3>Upload your data</h3>
        <hr>
        <div class="col-md-6">
            <div class="col-md-12">
            <form class="layui-form" action="">
                <div style="padding: 20px; background-color: #F2F2F2;">
                    <div class="layui-form-item">
                        <label class="layui-form-label">Data Type：</label>
                        <div class="layui-input-block">
                          <input type="radio" name="omics" value="lipidomics" title="Lipidomics" checked="">
                          <input type="radio" name="omics" value="metabonomics" title="Metabonomics">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">Data File</label>
                        <div class="layui-upload-drag" id="left">
                          <i class="layui-icon"></i>
                          <p>Click to upload, or drag the file here</p>
                          <div class="layui-hide" id="uploadDemoView">
                            <hr>
                            <input id="task_att_original" name='task_att_original' value="" />
                          </div>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </div>
        <div class="col-md-6">
            <div class="col-md-12">
            <form class="layui-form" action="">
                <div style="padding: 20px; background-color: #F2F2F2;">
                    <div class="layui-form-item">
                        <label class="layui-form-label">Data Type：</label>
                        <div class="layui-input-block">
                          <input type="radio" name="omics" value="microarray" title="RNA-seq/microarray" checked="">
                          <input type="radio" name="omics" value="proteinomics" title="Proteinomics">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">Data File</label>
                        <div class="layui-upload-drag" id="right">
                          <i class="layui-icon"></i>
                          <p>Click to upload, or drag the file here</p>
                          <div class="layui-hide" id="uploadDemoView">
                            <hr>
                            <input id="task_att_original" name='task_att_original' value="" />
                          </div>
                        </div>
                    </div>

                </div>
            </form>
            </div>
        </div>
        <h3>Try example data</h3>
        <hr>
            <div class="col-md-12 text-center">
                <br>
                <input type="file" name="file" id="test20">
                <button id="submit" class="layui-btn" type="submit">RUN</button>
            </div>

        </form>
    </div>
</div>
@endsection
@section('footer')
  @include('partials.footer')
@endsection
@section('js')
<script src="{{ asset('/layui/dist/layui.js') }}" charset="utf-8"></script>
<script>

layui.use('upload', function(){
  var upload = layui.upload;

  //执行实例
  var uploadInst = upload.render({
    elem: '#right'
    ,accept:'images'
    ,method: 'POST'
    ,data:{
        '_token':'{{csrf_token()}}'
    }
    ,url: '/upload' //改成您自己的上传接口
    ,done: function(res){
      layer.msg('upload succeed');
      $("#task_att_original").val(res.originalname);
      console.log(res)
    }
  });
  var uploadInst = upload.render({
    elem: '#left'
    ,accept:'images'
    ,method: 'POST'
    ,data:{
        '_token':'{{csrf_token()}}'
    }
    ,url: '/upload' //改成您自己的上传接口
    ,done: function(res){
      layer.msg('upload succeed');
      $("#task_att_original").val(res.originalname);
      console.log(res)
    }
  });
});
</script>
<script>
    $(document).ready(function(){
        changetheprogram();
        layui.use('form', function(){
          var form = layui.form; //只有执行了这一步，部分表单元素才会自动修饰成功
        });

    });

    function changetheprogram() {
        query_type = $("input[name='query_type']:checked").val();
        subject_type = $("input[name='subject_type']:checked").val();
        if (query_type == 'dna') {
            if (subject_type == 'dna') {
                $("#program").html("<option value=blastn>BLASTN</option>");
                $("#program").append("<option value=tblastx>TBLASTX</option>");
            }else if (subject_type == 'protein') {
                $("#program").html("<option value=blastx>BLASTX</option>");
            }
        }else if (query_type == 'protein') {
            if (subject_type == 'dna') {
                $("#program").html("<option value=tblastn>TBLASTN</option>");
            }else if (subject_type == 'protein') {
                $("#program").html("<option value=blastp>BLASTP</option>");
            }
        }
        $("#program").trigger("change");
    }


    $("input:radio").change(function (){
            changetheprogram();
        });


    $('#blastform').submit(function(e) {
        if($('#seq').val() == ''){
            layer.msg('Sequence is empty!');
            e.preventDefault();
        }
    })
</script>
@endsection

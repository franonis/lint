@extends('layouts.app')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('/layer/skin/default/layer.css') }}">
<link rel="stylesheet" href="{{ asset('/layui/layui-2.4.5/dist/css/layui.css') }}"  media="all">

@endsection
@section('navbar')
  @include('partials.navbar')
@endsection
@section('content')
<div class="container content">
    <div class="row">
        <h2>BLAST</h2>
        <hr>
        @include('partials.errors')

        <form id="blastform" method="post" action="{{ url('/tools/blast/run') }}">
            {{ csrf_field() }}
            <div class="col-md-12">
                <div class="col-md-3">
                    <h4>Omics Data</h4>
                </div>

                <div class="col-md-9">
                    <h5>
                        Input data of Omics（as csv）
                        <button id="example" type="button" class="pull-right button button-tiny button-primary">Example</button>
                    </h5>
                    <div style="padding: 20px; background-color: #F2F2F2;">
                        <button type="button" class="layui-btn" id="test1">
                            <i class="layui-icon">&#xe67c;</i>Upload file
                        </button>
                    </div><br>
                </div>
            </div>
            <HR style="FILTER:alpha(opacity=100,finishopacity=0,style=3)" width="90%"color=#987cb9 SIZE=3></HR>
            <div class="col-md-12">
                <div class="col-md-3">
                    <h4>SampleList</h4>
                </div>

                <div class="col-md-9">
                    <h5>
                        Input descriptional file of Omics data(as csv)
                        <button id="example" type="button" class="pull-right button button-tiny button-primary">Example</button>
                    </h5>
                    <div style="padding: 20px; background-color: #F2F2F2;">
                        <button type="button" class="layui-btn" id="test1">
                            <i class="layui-icon">&#xe67c;</i>Upload file
                        </button>
                    </div><br>
                </div>
                
            </div>
            <HR style="FILTER:alpha(opacity=100,finishopacity=0,style=3)" width="90%"color=#987cb9 SIZE=3></HR>
            <div class="col-md-12">
                <div class="col-md-3">
                    <h4>Control Group </h4>
                </div>
                <div class="col-md-9">
                    <h5>Choose group level</h5>
                    <select id="species" name="species" class="form-control">
                        <option value="dom_cucumber">group level 1</option>
                        <option value="wild_cucumber">group level 2</option>
                    </select>
                    <h4>Or, you can input group level chosen in dataSet[["groupsLevel"]:
                        <small>
                            <input id="hit_number" type="text" name="hit_number" value="50" style="width:8%; display:inline;" class="form-control" autocomplete="on"></input>
                        </small>
                </div>
            </div>
            <HR style="FILTER:alpha(opacity=100,finishopacity=0,style=3)" width="90%"color=#987cb9 SIZE=3></HR>
            <div class="col-md-12">
                <div class="col-md-3">
                    <h4>dataType</h4>
                </div>
                <div class="col-md-9">
                    <h5>Choose Data Type</h5>
                    <select id="species" name="species" class="form-control">
                        <option value="dom_cucumber">LipidSearch</option>
                        <option value="wild_cucumber">MS_DIAL</option>
                        <option value="wild_cucumber">Metabolites</option>
                        <option value="wild_cucumber">Proteins</option>
                    </select>
                </div>
            </div><br>
            <HR style="FILTER:alpha(opacity=100,finishopacity=0,style=3)" width="90%"color=#987cb9 SIZE=3></HR>
            <div class="col-md-12">
                <div class="col-md-3">
                    <h4>lip Field</h4>
                </div>
                <div class="col-md-9">
                    <h5>Choose Data Type</h5>
                    <select id="species" name="species" class="form-control">
                        <option value="dom_cucumber">firstline</option>
                        <option value="wild_cucumber">MS_DIAL</option>
                        <option value="wild_cucumber">Metabolites</option>
                        <option value="wild_cucumber">Proteins</option>
                    </select>
                </div>
            </div><br>
            <HR style="FILTER:alpha(opacity=100,finishopacity=0,style=3)" width="90%"color=#987cb9 SIZE=3>
            <div class="col-md-12">
                <div class="col-md-3">
                    <h4>delOddChainOpt</h4>
                </div>
                <div class="col-md-9">
                    <input id="query_dna" type="radio" value="dna" name="query_type" checked> <label> T</label><br>
                    <input id="query_protein" type="radio" value="protein" name="query_type"> <label> F</label>
                </div>
            </div><br>
            <HR style="FILTER:alpha(opacity=100,finishopacity=0,style=3)" width="90%"color=#987cb9 SIZE=3>
            <div class="col-md-12 text-center">
                <br>
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
<script src="{{ asset('/layui/layui-2.4.5/dist/layui.all.js') }}" ></script>
<script src="{{ asset('/layer/layer.js') }}"></script>
<script>
layui.use('upload', function(){
  var upload = layui.upload;
   
  //执行实例
  var uploadInst = upload.render({
    elem: '#test1' //绑定元素
    ,url: '/upload/' //上传接口
    ,done: function(res){
      //上传完毕回调
    }
    ,error: function(){
      //请求异常回调
    }
  });
});
</script>
<script>
    $(document).ready(function(){
        changetheprogram();

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


    $('#example').click(function(){
        $('#seq').html('');
        name = $(this).val();
        name =$("input[name='query_type']:checked").val();
        if(name == 'protein'){
            $('#seq').html(">A0A0A0LTV1\nMSTSELACAYAALALHDDGIAITAEKIAAVVAAAGLCVESYWPSLFAKLAEKRNIGDLLLNVGCGGGAAASVAVAAPTASAAAAPAIEEKREEPKEESDDDMGFSLFD");
        } else if(name == 'dna'){
            $('#seq').html(">A0A0A0LTV1\nATGTCTACCAGTGAACTCGCGTGCGCGTACGCCGCCCTGGCTCTTCACGATGATGGAATCGCAATCACTGCGGAAAAGATTGCAGCCGTTGTAGCAGCTGCGGGGCTCTGTGTGGAATCTTACTGGCCTAGCTTGTTTGCTAAATTGGCCGAGAAGAGGAACATTGGGGACCTTCTTCTTAATGTTGGCTGTGGAGGTGGCGCTGCGGCTTCTGTGGCTGTAGCTGCTCCTACCGCCAGTGCTGCTGCCGCTCCTGCCATCGAGGAAAAGAGGGAGGAGCCAAAGGAGGAGAGCGATGATGACATGGGATTCAGCTTATTCGATTAA");
        }
    });

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

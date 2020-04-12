<div class="form-group" id="frmcategory">
<label class="col-md-4 control-label textoc10" for="category">Category:</label>
<div class="col-md-6">
<a id="category" name="category" class="btn btn-primary btn-block" style="height:32px;background-color:#FFF;border:1px solid #ccc;"><i class="fas fa-caret-down inner-carret"></i>
</a>
</div>
<div class="col-md-4"></div>
<div class="col-md-6">
<div id="pcategoria" class="panel" style="border:1px solid #ccc;height:8rem;overflow-y:auto;overflow-x:hidden;">
        <div class="row" style="margin-left:2%;">
        @foreach ($data['ctgs'] as $c)
            <div class="col-md-4"><span style="font-size:0.6em;" class="checkcat"><input type="checkbox" class="category" name="categorieschk[]" value="{{$c->_id}}"/>{{$c->name}}</span></div>
        @endforeach
        </div>
</div>
</div>
</div>

<!-- Select Basic -->
<div class="form-group" id="frmsubcategory">
<label class="col-md-4 control-label textoc10" for="subcategory">Subcategory:</label>
<div class="col-md-6">
<select id="subcategory" name="subcategory[]" multiple="multiple" style="width: 100%;">
    <!--<option value="1">Option one</option>
    <option value="2">Option two</option>-->
</select>
</div>
</div>


<div id="frminterestage" class="form-group">
<label class="col-md-4 control-label textoc10" for="interestage">Age</label>
<div class="col-md-4">
<div class="checkbox">
<label for="ages-0">
    <input type="checkbox" name="ages[]" id="ages-0" value="1">
    13 - 19
</label>
</div>
<div class="checkbox">
<label for="ages-1">
    <input type="checkbox" name="ages[]" id="ages-1" value="2">
    20 - 29
</label>
</div>
<div class="checkbox">
<label for="ages-2">
    <input type="checkbox" name="ages[]" id="ages-2" value="3">
    30 - 39
</label>
</div>
<div class="checkbox">
<label for="ages-3">
    <input type="checkbox" name="ages[]" id="ages-3" value="4">
    40+
</label>
</div>
</div>
</div>

<div id="frminterestgender" class="form-group">
<div class="col-md-2"></div>
<label class="col-md-2 control-label textoc10" for="interestgender">Gender</label>
<div class="col-md-6">
<label class="checkbox-inline" for="interestgender-0">
    <input type="checkbox" name="interestgender[]" id="interestgender-0" value="1">
    Male
</label>
<label class="checkbox-inline" for="interestgender-1">
    <input type="checkbox" name="interestgender[]" id="interestgender-1" value="2">
    Female
</label>
<label class="checkbox-inline" for="interestgender-2">
    <input type="checkbox" name="interestgender[]" id="interestgender-2" value="3">
    Other
</label>
</div>
</div>

<div id="frminterestlevel" class="form-group">
<label class="col-md-4 control-label textoc10" for="level">Level:</label>
<div class="col-md-6">
    <select id="level" name="level" class="form-control">
        @foreach ($data['levels'] as $level)
            <option value="{{$level->_id}}">{{$level->name}}</option>
        @endforeach
    </select>
</div>
<br><br><br>
<div style="width: 100%;text-align: center;"><button id="save_user_changes_for_interest" class="btn btn-primary">SAVE</button></div>

</div>
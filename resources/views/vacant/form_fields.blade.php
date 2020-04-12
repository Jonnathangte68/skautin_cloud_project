
<div class="row">

<!-- Text input-->
<div class="form-group col-md-4">
  <label class="col-md-12 control-label" for="textinput">Name</label>  
  <div class="col-md-12">
  <input id="name" name="name" type="text" placeholder="" class="form-control input-md">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group col-md-4">
  <label class="col-md-12 control-label" for="title">Title</label>  
  <div class="col-md-12">
  <input id="title" name="title" type="text" placeholder="Executive Assistant, Software Developer, ..." class="form-control input-md">
    
  </div>
</div>

<!-- Textarea -->
<div class="form-group col-md-4">
  <label class="col-md-12 control-label" for="description">Description</label>
  <div class="col-md-12">                     
    <textarea class="form-control" id="description" name="description" placeholder="Administrative and executive assistants play an important role in a wide variety of industries, and these professionals are crucial to keeping many offices running smoothly. ..."></textarea>
  </div>
</div>



</div>




<div class="row">

<!-- Textarea -->
<div class="form-group col-md-4">
  <label class="col-md-12 control-label" for="requirements">Requirements</label>
  <div class="col-md-12">                     
    <textarea class="form-control" id="requirements" name="requirements" placeholder="    * Adept in Technology. ...
    * Verbal & Written Communication. ...
    * Organization. ...
    * Time Management. ...
    * Strategic Planning. ...
    * Resourcefulness. ...
    * Detail-Oriented. ...
    * Anticipates Needs."></textarea>
  </div>
</div>

<!-- Select Basic -->
<div class="form-group col-md-4">
  <label class="col-md-12 control-label" for="category">Category</label>
  <div class="col-md-12">
    <select id="category" name="category" class="form-control">
      @foreach($data[1] as $categ)
        <option value="{{$categ->_id}}">{{$categ->name}}</option>
      @endforeach
    </select>
  </div>
</div>

<!-- Select Basic -->
<div class="form-group col-md-4">
  <label class="col-md-12 control-label" for="subcategory">Subcategory</label>
  <div class="col-md-12">
    <select id="subcategory" name="subcategory" class="form-control">
      @foreach($data[2] as $subcateg)
        <option value="{{$subcateg->_id}}">{{$subcateg->name}}</option>
      @endforeach
    </select>
  </div>
</div>

</div>





<div class="row">

<!-- Select Basic -->
<div class="form-group col-md-4">
  <label class="col-md-12 control-label" for="country">Country</label>
  <div class="col-md-12">
    <select id="country" name="country" class="form-control">
      @foreach($data[5] as $countries)
        <option value="{{$countries->_id}}">{{$countries->name}}</option>
      @endforeach
    </select>
  </div>
</div>

<!-- Select Basic -->
<div class="form-group col-md-4">
  <label class="col-md-12 control-label" for="state">State</label>
  <div class="col-md-12">
    <select id="state" name="state" class="form-control">
      @foreach($data[6] as $states)
        <option value="{{$states->_id}}">{{$states->name}}</option>
      @endforeach
    </select>
  </div>
</div>

<!-- Select Basic -->
<div class="form-group col-md-4">
  <label class="col-md-12 control-label" for="city">City</label>
  <div class="col-md-12">
    <select id="city" name="city" class="form-control">
      @foreach($data[7] as $cities)
        <option value="{{$cities->_id}}">{{$cities->name}}</option>
      @endforeach
    </select>
  </div>
</div>



</div>

<div class="row">

<!-- Select Basic -->
<div class="form-group col-md-4">
  <label class="col-md-12 control-label" for="job_type">Type</label>
  <div class="col-md-12">
    <select id="job_type" name="job_type" class="form-control">
      @foreach($data[4] as $jtp)
        <option value="{{$jtp->_id}}">{{$jtp->name}}</option>
      @endforeach
    </select>
  </div>
</div>

<!-- Select Basic -->
<div class="form-group col-md-4">
  <label class="col-md-12 control-label" for="level">Level Required</label>
  <div class="col-md-12">
    <select id="level" name="level" class="form-control">
      @foreach($data[3] as $lvl)
        <option value="{{$lvl->_id}}">{{$lvl->name}}</option>
      @endforeach
    </select>
  </div>
</div>

<!-- File Button -->
<!-- Use the recruiter Image! --> 
<!--
  <div class="form-group col-md-4">
  <label class="col-md-12 control-label" for="imagen"></label>
  <div class="col-md-12">
    <input id="imagen" name="imagen" class="input-file btn-imagen-poco-hacia-abajo" type="file">
  </div>
</div>
-->

</div>


<button class="btn btn-primary btn-add-new-vacant">Submit</button>
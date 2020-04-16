<section class="form-content-new-job">

    <div class="row">

    <!-- Text input-->
    <div class="form-group col-md-4">
    <label class="col-md-12 control-label" for="title">Title</label>  
    <div class="col-md-12">
    <input id="title" name="title" type="text" placeholder="Executive Assistant, Software Developer, ..." class="form-control input-md">
        
    </div>
    </div>

    <!-- Textarea -->
    <div class="form-group col-md-12 no-boot-padding-col">
    <label class="col-md-12 control-label" for="description">Description</label>
    <div class="col-md-12">                     
        <textarea class="form-control higher-height-field" id="description" name="description" placeholder="Administrative and executive assistants play an important role in a wide variety of industries, and these professionals are crucial to keeping many offices running smoothly. ..."></textarea>
    </div>
    </div>



    </div>




    <div class="row">

    <!-- Textarea -->
    <div class="form-group col-md-12 no-boot-padding-col">
    <label class="col-md-12 control-label" for="requirements">Requirements</label>
    <div class="col-md-12">                     
        <textarea class="form-control higher-height-field" id="requirements" name="requirements" placeholder="    
        * Adept in Technology. ...
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
            <option value="">-- Select job category --</option>
        </select>
    </div>
    </div>

    <!-- Select Basic -->
    <div class="form-group col-md-4">
    <label class="col-md-12 control-label" for="subcategory">Subcategory</label>
    <div class="col-md-12">
        <select id="subcategory" name="subcategory" class="form-control">
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
        </select>
    </div>
    </div>

    <!-- Select Basic -->
    <div class="form-group col-md-4">
    <label class="col-md-12 control-label" for="state">State</label>
    <div class="col-md-12">
        <select id="state" name="state" class="form-control">
            <option>Please select a country.</option>
        </select>
    </div>
    </div>

    <!-- Select Basic -->
    <div class="form-group col-md-4">
    <label class="col-md-12 control-label" for="city">City</label>
    <div class="col-md-12">
        <select id="city" name="city" class="form-control">
            <option>Please select a state.</option>
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
        </select>
    </div>
    </div>

    <!-- Select Basic -->
    <div class="form-group col-md-4">
    <label class="col-md-12 control-label" for="level">Level Required</label>
    <div class="col-md-12">
        <select id="level" name="level" class="form-control">
        </select>
    </div>
    </div>

    </div>
</section>

<button id="submitNewJob" class="btn btn-primary btn-add-new-vacant">Submit</button>
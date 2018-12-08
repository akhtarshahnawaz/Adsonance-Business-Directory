<div class="span9 well">
<?php
$ci=& get_instance();
$ci->load->library('session');

if($ci->session->flashdata('notification')){
    $alertType = $ci->session->flashdata('alertType');
    $notification = $ci->session->flashdata('notification');
    $hasNotification=true;
}else{
    $hasNotification=false;
}

if($hasNotification):

    ?>
<div class="alert <?php echo $alertType;?>">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <?php echo $notification?>
</div>
    <?php endif; ?>


<?php   $this->load->helper('form');
$attributes = array('class' => 'form-horizontal ');
if(isset($update) && $update==true){
    $route='admin/listing/edit';
}else{
    $route='admin/listing/create';
}
echo form_open($route, $attributes); ?>

<input type="hidden" name="pkey" value="<?php if(isset($pkey)){ echo $pkey;}?>">


<div class="control-group">
    <label class="control-label" for="inputStatus">Status</label>
    <div class="controls">
        <input type="text" class="input-block-level" value="<?php if(!empty($data)){ echo $data['status'];}?>"  name="status" id="inputStatus" placeholder="Status (Give a Number Denomination)">
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="inputStatus">Status 2</label>
    <div class="controls">
        <input type="text" class="input-block-level" value="<?php if(!empty($data)){ echo $data['status2'];}?>"  name="status2" id="inputStatus2" placeholder="Status 2">
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="inputName">Business Name</label>
    <div class="controls">
        <input type="text" class="input-block-level" value="<?php if(!empty($data)){ echo $data['name'];}?>"  name="name" id="inputName" placeholder="Name of Business">
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="inputCategory">Category</label>
    <div class="controls">
        <select name="category_pkey" class="input-block-level"  id="inputCategory"  lastSelected="<?php if(!empty($data)){ echo $data['category_pkey'];}?>" >
            <?php if(!empty($categories)): foreach($categories as $row):?>
            <option value="<?php echo $row['pkey']; ?>"><?php echo $row['name']; ?></option>
            <?php endforeach; endif; ?>
        </select>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="inputContactPerson">Contact Person</label>
    <div class="controls">
        <input type="text" class="input-block-level" value="<?php if(!empty($data)){ echo $data['contact_person'];}?>"  name="contact_person" id="inputContactPerson" placeholder="Contact Person">
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="inputPhone">Phone</label>
    <div class="controls">
        <input type="text" class="input-block-level"  value="<?php if(!empty($data)){ echo $data['phone'];}?>"  name="phone" id="inputPhone" placeholder="Phone of Business">
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="inputEmail">Email</label>
    <div class="controls">
        <input type="email" class="input-block-level"  value="<?php if(!empty($data)){ echo $data['email'];}?>"  name="email" id="inputEmail" placeholder="Email of Business">
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="inputWebsite">Website</label>
    <div class="controls">
        <input type="text" class="input-block-level"  value="<?php if(!empty($data)){ echo $data['website'];}?>"  name="website" id="inputWebsite" placeholder="Website of Business">
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="inputExcerpt">Short Description</label>
    <div class="controls">
        <textarea  name="excerpt" class="input-block-level"  id="inputExcerpt" placeholder="Short Description"><?php if(!empty($data)){ echo $data['excerpt'];}?></textarea>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="inputImage">Image</label>
    <div class="controls">
        <input type="hidden" name="image" value="<?php if(!empty($data)){ echo $data['image'];}?>" id="image">
        <input type="file"  class="input-block-level" action="<?php echo site_url('admin/listing/uploadImage');?>"  name="inputImage" id="inputImage"></br></br>
        <span class="label label-important" id="imageUploadError"></span></br></br>
        <img src="<?php if(!empty($data) && $data['image']!=''){ echo base_url().$this->config->item('listingBannerUploadDirectory').$data['image']; }else{ assetLink(array('listingScreenshot.png'=>'image')); } ?>" id="listingImage" width="150px" height="150px" />
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="inputTags">Tags</label>
    <div class="controls">
        <input type="text" class="input-block-level"  value="<?php if(!empty($data)){ echo $data['tags'];}?>"  name="tags" id="inputTags" placeholder="Tags for Business like theatre, chinese restaurant etc">
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="inputStreetAddress">Street Address</label>
    <div class="controls">
        <input type="text" class="input-block-level"  value="<?php if(!empty($data)){ echo $data['street'];}?>"  name="street" id="inputStreetAddress" placeholder="Street Address">
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="inputLocality">Locality</label>
    <div class="controls">
        <input type="text" class="input-block-level"  value="<?php if(!empty($data)){ echo $data['locality'];}?>"  name="locality" id="inputLocality" placeholder="Locality ( i.e. Area)">
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="inputCity">City</label>
    <div class="controls">
        <input type="text" class="input-block-level"  value="<?php if(!empty($data)){ echo $data['city'];}?>"  name="city" id="inputCity" placeholder="City">
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="inputPincode">Pincode</label>
    <div class="controls">
        <input type="text" class="input-block-level"  value="<?php if(!empty($data)){ echo $data['pincode'];}?>"  name="pincode" id="inputPincode" placeholder="Pincode">
    </div>
</div>

<div class="control-group">
<label class="control-label" for="inputCountry">Country</label>
<div class="controls">
<select name="country" class="input-medium" id="inputCountry"  lastSelected="<?php if(!empty($data)){ echo $data['country'];}?>" >
<option value="Afganistan">Afghanistan</option>
<option value="Albania">Albania</option>
<option value="Algeria">Algeria</option>
<option value="American Samoa">American Samoa</option>
<option value="Andorra">Andorra</option>
<option value="Angola">Angola</option>
<option value="Anguilla">Anguilla</option>
<option value="Antigua &amp; Barbuda">Antigua &amp; Barbuda</option>
<option value="Argentina">Argentina</option>
<option value="Armenia">Armenia</option>
<option value="Aruba">Aruba</option>
<option value="Australia">Australia</option>
<option value="Austria">Austria</option>
<option value="Azerbaijan">Azerbaijan</option>
<option value="Bahamas">Bahamas</option>
<option value="Bahrain">Bahrain</option>
<option value="Bangladesh">Bangladesh</option>
<option value="Barbados">Barbados</option>
<option value="Belarus">Belarus</option>
<option value="Belgium">Belgium</option>
<option value="Belize">Belize</option>
<option value="Benin">Benin</option>
<option value="Bermuda">Bermuda</option>
<option value="Bhutan">Bhutan</option>
<option value="Bolivia">Bolivia</option>
<option value="Bonaire">Bonaire</option>
<option value="Bosnia &amp; Herzegovina">Bosnia &amp; Herzegovina</option>
<option value="Botswana">Botswana</option>
<option value="Brazil">Brazil</option>
<option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
<option value="Brunei">Brunei</option>
<option value="Bulgaria">Bulgaria</option>
<option value="Burkina Faso">Burkina Faso</option>
<option value="Burundi">Burundi</option>
<option value="Cambodia">Cambodia</option>
<option value="Cameroon">Cameroon</option>
<option value="Canada">Canada</option>
<option value="Canary Islands">Canary Islands</option>
<option value="Cape Verde">Cape Verde</option>
<option value="Cayman Islands">Cayman Islands</option>
<option value="Central African Republic">Central African Republic</option>
<option value="Chad">Chad</option>
<option value="Channel Islands">Channel Islands</option>
<option value="Chile">Chile</option>
<option value="China">China</option>
<option value="Christmas Island">Christmas Island</option>
<option value="Cocos Island">Cocos Island</option>
<option value="Colombia">Colombia</option>
<option value="Comoros">Comoros</option>
<option value="Congo">Congo</option>
<option value="Cook Islands">Cook Islands</option>
<option value="Costa Rica">Costa Rica</option>
<option value="Cote DIvoire">Cote D'Ivoire</option>
<option value="Croatia">Croatia</option>
<option value="Cuba">Cuba</option>
<option value="Curaco">Curacao</option>
<option value="Cyprus">Cyprus</option>
<option value="Czech Republic">Czech Republic</option>
<option value="Denmark">Denmark</option>
<option value="Djibouti">Djibouti</option>
<option value="Dominica">Dominica</option>
<option value="Dominican Republic">Dominican Republic</option>
<option value="East Timor">East Timor</option>
<option value="Ecuador">Ecuador</option>
<option value="Egypt">Egypt</option>
<option value="El Salvador">El Salvador</option>
<option value="Equatorial Guinea">Equatorial Guinea</option>
<option value="Eritrea">Eritrea</option>
<option value="Estonia">Estonia</option>
<option value="Ethiopia">Ethiopia</option>
<option value="Falkland Islands">Falkland Islands</option>
<option value="Faroe Islands">Faroe Islands</option>
<option value="Fiji">Fiji</option>
<option value="Finland">Finland</option>
<option value="France">France</option>
<option value="French Guiana">French Guiana</option>
<option value="French Polynesia">French Polynesia</option>
<option value="French Southern Ter">French Southern Ter</option>
<option value="Gabon">Gabon</option>
<option value="Gambia">Gambia</option>
<option value="Georgia">Georgia</option>
<option value="Germany">Germany</option>
<option value="Ghana">Ghana</option>
<option value="Gibraltar">Gibraltar</option>
<option value="Great Britain">Great Britain</option>
<option value="Greece">Greece</option>
<option value="Greenland">Greenland</option>
<option value="Grenada">Grenada</option>
<option value="Guadeloupe">Guadeloupe</option>
<option value="Guam">Guam</option>
<option value="Guatemala">Guatemala</option>
<option value="Guinea">Guinea</option>
<option value="Guyana">Guyana</option>
<option value="Haiti">Haiti</option>
<option value="Hawaii">Hawaii</option>
<option value="Honduras">Honduras</option>
<option value="Hong Kong">Hong Kong</option>
<option value="Hungary">Hungary</option>
<option value="Iceland">Iceland</option>
<option value="India" selected="selected">India</option>
<option value="Indonesia">Indonesia</option>
<option value="Iran">Iran</option>
<option value="Iraq">Iraq</option>
<option value="Ireland">Ireland</option>
<option value="Isle of Man">Isle of Man</option>
<option value="Israel">Israel</option>
<option value="Italy">Italy</option>
<option value="Jamaica">Jamaica</option>
<option value="Japan">Japan</option>
<option value="Jordan">Jordan</option>
<option value="Kazakhstan">Kazakhstan</option>
<option value="Kenya">Kenya</option>
<option value="Kiribati">Kiribati</option>
<option value="Korea North">Korea North</option>
<option value="Korea Sout">Korea South</option>
<option value="Kuwait">Kuwait</option>
<option value="Kyrgyzstan">Kyrgyzstan</option>
<option value="Laos">Laos</option>
<option value="Latvia">Latvia</option>
<option value="Lebanon">Lebanon</option>
<option value="Lesotho">Lesotho</option>
<option value="Liberia">Liberia</option>
<option value="Libya">Libya</option>
<option value="Liechtenstein">Liechtenstein</option>
<option value="Lithuania">Lithuania</option>
<option value="Luxembourg">Luxembourg</option>
<option value="Macau">Macau</option>
<option value="Macedonia">Macedonia</option>
<option value="Madagascar">Madagascar</option>
<option value="Malaysia">Malaysia</option>
<option value="Malawi">Malawi</option>
<option value="Maldives">Maldives</option>
<option value="Mali">Mali</option>
<option value="Malta">Malta</option>
<option value="Marshall Islands">Marshall Islands</option>
<option value="Martinique">Martinique</option>
<option value="Mauritania">Mauritania</option>
<option value="Mauritius">Mauritius</option>
<option value="Mayotte">Mayotte</option>
<option value="Mexico">Mexico</option>
<option value="Midway Islands">Midway Islands</option>
<option value="Moldova">Moldova</option>
<option value="Monaco">Monaco</option>
<option value="Mongolia">Mongolia</option>
<option value="Montserrat">Montserrat</option>
<option value="Morocco">Morocco</option>
<option value="Mozambique">Mozambique</option>
<option value="Myanmar">Myanmar</option>
<option value="Nambia">Nambia</option>
<option value="Nauru">Nauru</option>
<option value="Nepal">Nepal</option>
<option value="Netherland Antilles">Netherland Antilles</option>
<option value="Netherlands">Netherlands (Holland, Europe)</option>
<option value="Nevis">Nevis</option>
<option value="New Caledonia">New Caledonia</option>
<option value="New Zealand">New Zealand</option>
<option value="Nicaragua">Nicaragua</option>
<option value="Niger">Niger</option>
<option value="Nigeria">Nigeria</option>
<option value="Niue">Niue</option>
<option value="Norfolk Island">Norfolk Island</option>
<option value="Norway">Norway</option>
<option value="Oman">Oman</option>
<option value="Pakistan">Pakistan</option>
<option value="Palau Island">Palau Island</option>
<option value="Palestine">Palestine</option>
<option value="Panama">Panama</option>
<option value="Papua New Guinea">Papua New Guinea</option>
<option value="Paraguay">Paraguay</option>
<option value="Peru">Peru</option>
<option value="Phillipines">Philippines</option>
<option value="Pitcairn Island">Pitcairn Island</option>
<option value="Poland">Poland</option>
<option value="Portugal">Portugal</option>
<option value="Puerto Rico">Puerto Rico</option>
<option value="Qatar">Qatar</option>
<option value="Republic of Montenegro">Republic of Montenegro</option>
<option value="Republic of Serbia">Republic of Serbia</option>
<option value="Reunion">Reunion</option>
<option value="Romania">Romania</option>
<option value="Russia">Russia</option>
<option value="Rwanda">Rwanda</option>
<option value="St Barthelemy">St Barthelemy</option>
<option value="St Eustatius">St Eustatius</option>
<option value="St Helena">St Helena</option>
<option value="St Kitts-Nevis">St Kitts-Nevis</option>
<option value="St Lucia">St Lucia</option>
<option value="St Maarten">St Maarten</option>
<option value="St Pierre &amp; Miquelon">St Pierre &amp; Miquelon</option>
<option value="St Vincent &amp; Grenadines">St Vincent &amp; Grenadines</option>
<option value="Saipan">Saipan</option>
<option value="Samoa">Samoa</option>
<option value="Samoa American">Samoa American</option>
<option value="San Marino">San Marino</option>
<option value="Sao Tome & Principe">Sao Tome &amp; Principe</option>
<option value="Saudi Arabia">Saudi Arabia</option>
<option value="Senegal">Senegal</option>
<option value="Seychelles">Seychelles</option>
<option value="Sierra Leone">Sierra Leone</option>
<option value="Singapore">Singapore</option>
<option value="Slovakia">Slovakia</option>
<option value="Slovenia">Slovenia</option>
<option value="Solomon Islands">Solomon Islands</option>
<option value="Somalia">Somalia</option>
<option value="South Africa">South Africa</option>
<option value="Spain">Spain</option>
<option value="Sri Lanka">Sri Lanka</option>
<option value="Sudan">Sudan</option>
<option value="Suriname">Suriname</option>
<option value="Swaziland">Swaziland</option>
<option value="Sweden">Sweden</option>
<option value="Switzerland">Switzerland</option>
<option value="Syria">Syria</option>
<option value="Tahiti">Tahiti</option>
<option value="Taiwan">Taiwan</option>
<option value="Tajikistan">Tajikistan</option>
<option value="Tanzania">Tanzania</option>
<option value="Thailand">Thailand</option>
<option value="Togo">Togo</option>
<option value="Tokelau">Tokelau</option>
<option value="Tonga">Tonga</option>
<option value="Trinidad &amp; Tobago">Trinidad &amp; Tobago</option>
<option value="Tunisia">Tunisia</option>
<option value="Turkey">Turkey</option>
<option value="Turkmenistan">Turkmenistan</option>
<option value="Turks &amp; Caicos Is">Turks &amp; Caicos Is</option>
<option value="Tuvalu">Tuvalu</option>
<option value="Uganda">Uganda</option>
<option value="Ukraine">Ukraine</option>
<option value="United Arab Erimates">United Arab Emirates</option>
<option value="United Kingdom">United Kingdom</option>
<option value="United States of America">United States of America</option>
<option value="Uraguay">Uruguay</option>
<option value="Uzbekistan">Uzbekistan</option>
<option value="Vanuatu">Vanuatu</option>
<option value="Vatican City State">Vatican City State</option>
<option value="Venezuela">Venezuela</option>
<option value="Vietnam">Vietnam</option>
<option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
<option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
<option value="Wake Island">Wake Island</option>
<option value="Wallis &amp; Futana Is">Wallis &amp; Futana Is</option>
<option value="Yemen">Yemen</option>
<option value="Zaire">Zaire</option>
<option value="Zambia">Zambia</option>
<option value="Zimbabwe">Zimbabwe</option>
</select>
</div>
</div>

<input type="hidden"  value="<?php if(!empty($data)){ echo $data['location_pointer'];}?>"  name="location_pointer">

<!-- <div class="control-group">
        <label class="control-label" for="inputLocationPointer">Location Pointer</label>
        <div class="controls">
            <input type="text" class="input-block-level"  value="<?php if(!empty($data)){ echo $data['location_pointer'];}?>"  name="location_pointer" id="inputLocationPointer" placeholder="Select Location of your Business">
        </div>
    </div>-->

<div class="control-group">
    <label class="control-label" for="inputDescription">Detailed Description</label>
    <div class="controls">
        <textarea  name="description" id="inputDescription" placeholder="Detailed Description about your Business"><?php if(!empty($data)){ echo $data['description'];}?></textarea>
    </div>
</div>





<div class="control-group">
    <div class="controls">
        <?php
        if(isset($update) && $update==true){
            $button="Update";
        }else{
            $button="Create";
        }
        ?>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-info btn-block"><?php echo $button;?></button>
    </div>
</div>
</form>

</div>
</div>


<?php
loadAsset(array('jquery-1.7.1.min.js'=>'script','ckeditor/ckeditor.js'=>'script','ajaxupload.js'=>'script'));
loadBootstrap('script.min') ;
?>


<script type="text/javascript">
    var category =$('#inputCategory').attr('lastSelected');
    var categoryItems=$('#inputCategory').children('option[value="'+category+'"]');
    categoryItems.attr('selected','selected');


    var country =$('#inputCountry').attr('lastSelected');
    var countryItems=$('#inputCountry').children('option[value="'+country+'"]');
    countryItems.attr('selected','selected');



    CKEDITOR.replace( 'inputDescription',{
        toolbar : [
            { name: 'clipboard',   items : [ 'PasteText','PasteFromWord'] },
            { name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript'] },
            { name: 'paragraph',   items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ] },
            { name: 'links',       items : [ 'Link','Unlink','Anchor' ] },
            { name: 'styles',      items : [ 'Styles','Format','Font','FontSize' ] },
            { name: 'colors',      items : [ 'TextColor','BGColor' ] },
            { name: 'tools',       items : [ 'Maximize'] }
        ]
    });


    //Ajax Banner Image Upload
    $(document).ready(function(){

        new AjaxUpload('inputImage', {
            action: $('#inputImage').attr('action'),
            name: 'inputImage',
            onSubmit: function(file, extension) {
                $('#listingImage').attr('src','<?php assetLink(array('loading-screenshot.gif'=>'image'));  ?>');

            },
            onComplete: function(file, response) {
                    if(response.indexOf('<span>')>=0 && response.indexOf('</span>')>=0){
                        $('#imageUploadError').html(response);
                        $('#listingImage').attr('src','<?php assetLink(array('listingScreenshot.png'=>'image'));  ?>');
                    }else{
                        $('#listingImage').attr('src',response);
                        var image=response.split('/');
                        image=image[image.length-1];
                        $('#image').attr('value',image);
                    }
            }
        });
    });

</script>
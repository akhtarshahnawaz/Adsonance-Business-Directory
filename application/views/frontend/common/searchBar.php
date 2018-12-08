    <div class="row-fluid">
        <div class="well">
            <?php   $this->load->helper('form');
            $attributes = array('class' => 'form-horizontal','method'=>'get');
            $route='home/search';
            echo form_open($route, $attributes); ?>
            <div class="span1"><input type="hidden" name="page" value="0"></div>
            <div class="span6"><input type="text" name="term" value="<?php if(isset($term)){ echo $term; }?>" class="input-block-level" placeholder="Search anything"> </div>
            <div class="span2">
                <input type="text" name="locality" value="<?php if(isset($locality)){ echo $locality; }?>" class="input-block-level" placeholder="Locality">
            </div>
            <div class="span1">
                <input type="text" name="city" value="<?php if(isset($city)){ echo $city; }else{ echo $this->input->cookie('city');}?>"  class="input-block-level" placeholder="City">
            </div>
            <div class="span1"><button type="submit" class="btn btn-block btn-primary">Search</button></div>
            <div class="span1"></div>
            </form>
        </div>
    </div>

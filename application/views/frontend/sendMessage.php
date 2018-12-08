<?php   $this->load->helper('form');
$attributes = array('class' => 'form-horizontal ');

echo form_open('home/sendMessage', $attributes); ?>

<input type="hidden"  value="<?php if(isset($pkey)){ echo $pkey;}?>" name="pkey">


<input type="text" class="input-block-level" value="<?php if(!empty($data)){ echo $data['name'];}?>"  name="name" id="inputName" placeholder="Full Name"></br></br>
<input type="email" class="input-block-level" value="<?php if(!empty($data)){ echo $data['email'];}?>"  name="email" id="inputEmail" placeholder="Email Address"></br></br>
<input type="text" class="input-block-level" value="<?php if(!empty($data)){ echo $data['phone'];}?>"  name="phone" id="inputPhone" placeholder="Phone"></br></br>
<label for="inputMessage">Message</label>
<textarea class="input-block-level" value="<?php if(!empty($data)){ echo $data['message'];}?>"  name="message"  id="inputMessage">
</textarea>
</br></br>

<p class="pull-right">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
    <button class="btn btn-primary" type="submit">Send Now</button>
</p>
</form>


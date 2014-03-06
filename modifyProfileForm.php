<style>
  #modifyProfileForm {
    display: none;
  }
  
  #modify_profile_description {
    resize: none;
  }
  
  #modify_profile_img_url {
    
  }
  
  
</style>

<div id="modifyProfileForm" style="display: none">
  <p><input type="text" id="modify_profile_img_url" placeHolder="URL of your profile picture" /></p>
  <p><textarea placeholder="Description:" rows="9" cols="29" maxlength="270" id="modify_profile_description"></textarea></p>
  <p><button onClick="check_modify_profile_form()">Submit</button></p>
</div>
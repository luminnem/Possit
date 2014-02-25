<style>
#newPicArea textarea {
    background: #000000;
	//background: -moz-linear-gradient(to top, #FFFFF0 0%, #FEFDCA 100%);
	//background: linear-gradient(to top, #FFFFF0 0%, #FEFDCA 100%);
	color: whiteSmoke !important;
    
	padding:15px; 
    font-family: 'Nothing You Could Do', Arial;
    font-size: 20px;
    color: #000; 
    width:250px; 
    margin: 12px;

    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
    -moz-box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
    -webkit-box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
    resize: none;
}

.postAreaButton {
	background-color: transparent;
	border: 0;
}

#newPicArea {
    transition: all 500ms;
    width: 305px;
    height: 400px;
    
    z-index: 99;
    
    position:absolute;
    left:0; 
    right:0;
    top:0; 
    bottom:0;
    margin:auto;

    max-width:100%;
    max-height:100%;
    overflow:auto;
}
#newPicArea #title {
    color: #555;
    font: 22px Helvetica;
    padding: 12px;
    text-align: left;
    height: 5px;
    
}

#newPicCaption {
	border: 0;
	font-size: 20px;
}
</style>

<div id="newPicArea" class="scroll-box">
        <a style="float:right;" href="javascript:void(0)" title="Close" onClick="theBox(false, 'newPicArea', '')"><img src="/resources/close.png"></a>
		<p id="title">New pic</p>
		<textarea cols="10" rows="6" maxLength="270" id="picAreaUrl" placeHolder="Picture url"></textarea>
		<input type="text" id="newPicCaption" placeHolder="Caption">
		<p>
		    <button class="login_button_big" title="Post it" onClick="checkPicData()">Send</button>
		</p>
</div>
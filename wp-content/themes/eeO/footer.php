<div class="clear"></div>

</div>



<div id="footer">

    <div class="footer1">
        <ul id="footerwidgeted-1">
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer #1') ) : ?>
			<li id="link-list-1">
                <h4><?php _e("Footer #1 Widget"); ?></h4>
                	<p><?php _e("This is an example of a text widget that you can place to describe a particular product or service. Use it as a way to get your visitors interested, so they can click through and read more about it."); ?></p>
            </li>
			<?php endif; ?> 
        </ul>	
    </div>	
    
    <div class="footer2">
        <ul id="footerwidgeted-2">
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer #2') ) : ?>
			<li id="link-list-2">
                <h4><?php _e("Footer #2 Widget"); ?></h4>
                	<p><?php _e("This is an example of a text widget that you can place to describe a particular product or service. Use it as a way to get your visitors interested, so they can click through and read more about it."); ?></p>
            </li>
			<?php endif; ?> 
        </ul>	
    </div>	
    
    <div class="footer3">
        <ul id="footerwidgeted-3">
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer #3') ) : ?>
			<li id="link-list-3">
                <h4><?php _e("Footer #3 Widget"); ?></h4>
                	<p><?php _e("This is an example of a text widget that you can place to describe a particular product or service. Use it as a way to get your visitors interested, so they can click through and read more about it."); ?></p>
            </li>
			<?php endif; ?> 
        </ul>	
    </div>	
    
    <div class="footer4">
        <ul id="footerwidgeted-4">
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer #4') ) : ?>
			<li id="link-list-4">
                <h4><?php _e("Footer #4 Widget"); ?></h4>
                	<p><?php _e("This is an example of a text widget that you can place to describe a particular product or service. Use it as a way to get your visitors interested, so they can click through and read more about it."); ?></p>
            </li>
			<?php endif; ?> 
        </ul>	
    </div>
    
<div class="clear"></div>
    
</div>
                
<div id="copyright">

    <div class="copyright">
		<p><?php echo date('Y'); ?> &copy; | Özgün yazıların tüm hakları saklıdır, fotoğraflar için mail atınız, alıntıları çalabilirsiniz. |<a href="http://eeo.gen.tr"> eeO v1.2 </a>
    </div>
    
</div>
                                    
<?php do_action('wp_footer'); ?>

<?php // begin code for the javascript which is necessary for the dropdown menu to display properly in IE6 ?>    
	<script src="<?php bloginfo('template_url'); ?>/js/dropdown.js" type="text/javascript"></script>
<?php // end code  ?>


<table width="960" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <th height="60" align="left" scope="col"><form name="count" id="count"><input name="count2" type="text" class="field" size="80" />
    </form>


<script>

/*
javascriptkit
*/


//change the text below to reflect your own,
var before=""
var current="Hoşgeldin eeO"
var montharray=new Array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec")

function countdown(yr,m,d){
theyear=yr;themonth=m;theday=d
var today=new Date()
var todayy=today.getYear()
if (todayy < 1000)
todayy+=1900
var todaym=today.getMonth()
var todayd=today.getDate()
var todayh=today.getHours()
var todaymin=today.getMinutes()
var todaysec=today.getSeconds()
var todaystring=montharray[todaym]+" "+todayd+", "+todayy+" "+todayh+":"+todaymin+":"+todaysec
futurestring=montharray[m-1]+" "+d+", "+yr
dd=Date.parse(futurestring)-Date.parse(todaystring)
dday=Math.floor(dd/(60*60*1000*24)*1)
dhour=Math.floor((dd%(60*60*1000*24))/(60*60*1000)*1)
dmin=Math.floor(((dd%(60*60*1000*24))%(60*60*1000))/(60*1000)*1)
dsec=Math.floor((((dd%(60*60*1000*24))%(60*60*1000))%(60*1000))/1000*1)
if(dday==0&&dhour==0&&dmin==0&&dsec==1){
document.forms.count.count2.value=current
return
}
else
document.forms.count.count2.value="eeO'nün Askerden Gelmesine "+dday+ " gün, "+dhour+" saat, "+dmin+" dakika ve "+dsec+" saniye kaldı."+before
setTimeout("countdown(theyear,themonth,theday)",1000)
}
//enter the count down date using the format year/month/day
countdown(2011,6,21)
</script></th>
  </tr>
</table>

</body>
</html>
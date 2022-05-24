@include('emails.header')

<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">Hi {{@$data['f_name']}}</p>
<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">Thanks so much for your interest in our Best Local Chef partners program. We created this program to help you bring more value to your temporary rental home. Here’s what you need to do to complete your approval process:</p>
<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">Add Best Local Chef to your temporary rental profile under <strong>amenities, dining</strong> - so that your guests know you’re a  partner.</p>
<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">Print this advertising brochure to place in your home for your guests to receive 10% off their booking with Best Local Chef.</p>
<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">That’s it, you’re all set to go</p>
<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">If you have any questions or comments please contact us at <a href="mailto:support@bestlocalchef.com">support@bestlocalchef.com</a></p>



@include('emails.footer')
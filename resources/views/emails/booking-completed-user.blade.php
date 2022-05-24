@include('emails.header')

<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">Hi {{@$user->first_name}}</p>

<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">Thanks for booking with <a href="https://bestlocalchef.com/">Best Local Chef</a>. We hope you’ve enjoyed the service provided. To keep our chefs at their best, please provide a review for your chef and the service provided.</p>
<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">Ready to <a href="https://bestlocalchef.com/find-a-chef">book again</a>? If you would like to book the same chef, or a new chef don’t hesitate to visit Best Local Chef and get started.</p> 
<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">Did you know you can book a service for others as well? Check out how you can <strong><u>gift others</u></strong> with a <a href="https://bestlocalchef.com/">Best Local Chef</a> experience.
</p>
<p style="color:#3d4852;font-size: 16px;line-height:1.5em;">Need support? Contact us at <a href="mailto:support@bestlocalchef.com">support@bestlocalchef.com.</a></p>
@include('emails.footer')
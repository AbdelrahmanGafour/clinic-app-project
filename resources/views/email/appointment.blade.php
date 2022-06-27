Dear {{ $mailData['name'] }},
<p>Thank you for booking your appointment with our Hospital.</p>
<p>The details of your appointment are below:</p>
<p>Date: {{ $mailData['date'] }}</p>
<p>Time: {{ $mailData['time'] }}</p>
<p>Doctor: {{ $mailData['doctorName'] }}</p>
<br>
Location: Address Street, Cairo, Egypt
<br>
Contact: 022 - 0214579655

<x-mail::message>
	# Join eboard

	You've been invited to join the {{ $department }} deparment at eboard, get started with the registering process to
	get
	access.

	<x-mail::button :url="$url">
		Get started
	</x-mail::button>

	Thanks,<br />
	{{ config('app.name') }}
</x-mail::message>

<div class="content">
    <div class="title">Something went wrong.</div>

    @if(app()->bound('sentry') && !empty(Sentry::getLastEventID()))
        <div class="subtitle">Error ID: {{ Sentry::getLastEventID() }}</div>

        <!-- Sentry JS SDK 2.1.+ required -->
        <script src="https://cdn.ravenjs.com/3.3.0/raven.min.js"></script>

        <script>
            Raven.showReportDialog({
                eventId: '{{ Sentry::getLastEventID() }}',
                // use the public DSN (dont include your secret!)
                dsn: 'https://b53658ff4ec749719da39905217d41e0@sentry.io/1366253',
                user: {
                    'name': 'Jane Doe',
                    'email': 'jane.doe@example.com',
                }
            });
        </script>
    @endif
</div>
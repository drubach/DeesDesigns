""" Checkout app. """
from django.apps import AppConfig


class CheckoutConfig(AppConfig):
    """
    Configure checkout app.
    """
    default_auto_field = 'django.db.models.BigAutoField'
    name = 'checkout'

    def ready(self):
        """
        Ensuring ability to update or delete order lineitems.
        """
        import checkout.signals

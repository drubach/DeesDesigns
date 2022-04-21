""" Cart app. """
from django.apps import AppConfig


class CartConfig(AppConfig):
    """
    Cart app config.
    """
    default_auto_field = 'django.db.models.BigAutoField'
    name = 'cart'

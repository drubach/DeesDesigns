""" Cart Admin. """
from django.contrib import admin
from cart.models import UserCart


class UserCartAdmin(admin.ModelAdmin):
    """
    Create UserCartAdmin.
    """
    list_display = (
        'user',
        'cart',
    )
    ordering = ('user',)

admin.site.register(UserCart)

""" Models for cart view. """
from django.db import models
from django.contrib.auth.models import User

# Create your models here.

class UserCart(models.Model):
    """ Basic cart model. """
    user = models.OneToOneField(User, on_delete=models.CASCADE)
    grand_total = 0
    cart = []
    

    def __str__(self):
        return str(self.user)

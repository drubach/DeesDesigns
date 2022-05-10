""" Models for cart view. """
from django.db import models
from django.contrib.auth.models import User

# Create your models here.

class UserCart(models.Model):
    """ Basic cart model. """
    
    cart = []
    
    def __str__(self):
        return self.user.username

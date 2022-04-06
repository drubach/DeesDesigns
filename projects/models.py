""" Models for Projects App """
from django.db import models
from django.contrib.auth.models import User

class Type(models.Model):
    """ db Model for Types of projects """
    name = models.CharField(max_length=254)
    friendly_name = models.CharField(max_length=254, null=True, blank=True)

    def __str__(self):
        """ Function to return type name. """
        return str(self.name)

    def get_friendly_name(self):
        """ Function to return type friendly name. """
        return self.friendly_name

class Project(models.Model):
    """ db Model for project info """
    user = models.ForeignKey(User, on_delete=models.CASCADE, default=1)
    project_name = models.CharField(max_length=254)
    description = models.TextField()
    cost = models.DecimalField(max_digits=8, decimal_places=0)
    type = models.ForeignKey('Type', null=True, blank=True, on_delete=models.SET_NULL)
    completed = models.IntegerField(null=True, blank=True)
    paid = models.IntegerField(null=True, blank=True)
    image_url = models.URLField(max_length=1024, null=True, blank=True)
    image = models.ImageField(null=True, blank=True)

    def __str__(self):
        """ Function to return project name. """
        return str(self.project_name)

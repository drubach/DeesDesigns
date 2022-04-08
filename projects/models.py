***REMOVED*** Models for Projects App ***REMOVED***
from django.db import models
from django.contrib.auth.models import User

class Type(models.Model):
    ***REMOVED*** db Model for Types of projects ***REMOVED***
    class Meta:
        ***REMOVED*** Ensure plural name for the group. ***REMOVED***
        verbose_name_plural = 'Types'

    name = models.CharField(max_length=254)
    friendly_name = models.CharField(max_length=254, null=True, blank=True)

    def __str__(self):
        ***REMOVED*** Function to return type name. ***REMOVED***
        return str(self.name)

    def get_friendly_name(self):
        ***REMOVED*** Function to return type friendly name. ***REMOVED***
        return self.friendly_name

class Project(models.Model):
    ***REMOVED*** db Model for project info ***REMOVED***
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
        ***REMOVED*** Function to return project name. ***REMOVED***
        return str(self.project_name)

***REMOVED*** Add models for Projects app. ***REMOVED***
from django.contrib import admin
from .models import Project, Type

# Register your models here.
admin.site.register(Project)
admin.site.register(Type)

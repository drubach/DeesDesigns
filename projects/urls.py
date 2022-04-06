***REMOVED*** urls - home. ***REMOVED***

#from django.contrib import admin
from django.urls import path
from . import views

urlpatterns = [
    path('', views.all_projects, name='projects'),
***REMOVED***

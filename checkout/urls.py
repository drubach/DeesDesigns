""" urls - home. """

#from django.contrib import admin
from django.urls import path
from . import views

urlpatterns = [
    path('', views.checkout, name='checkout'),
    #path('privacypolicy/', views.privacy_policy, name='privacypolicy')
]

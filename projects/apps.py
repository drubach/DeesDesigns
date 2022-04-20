""" Configure app. """
from django.apps import AppConfig


class ProjectsConfig(AppConfig):
    """ Projects app config. """
    default_auto_field = 'django.db.models.BigAutoField'
    name = 'projects'

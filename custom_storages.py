""" Storage location setup for AWS. """
from django.conf import settings
from storages.backends.s3boto3 import S3Boto3Storage

class StaticStorage(S3Boto3Storage):
    """ Setting static file location. """
    location = settings.STATICFILES_LOCATION


class MediaStorages(S3Boto3Storage):
    """ Setting media file location. """
    location = settings.MEDIAFILES_LOCATION

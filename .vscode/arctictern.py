***REMOVED***
arctictern.py
A little script that does a big migration
***REMOVED***

import json
***REMOVED***
import requests
import shutil
import subprocess
import sys
from os.path import exists

BASE_URL = "https://raw.githubusercontent.com/Code-Institute-Org/gitpod-full-template/master/"

BACKUP = True
MIGRATE = False
CURRENT_VERSION = 1.0
THIS_VERSION = 1.0


MIGRATE_FILE_LIST = [{"filename": ".theia/settings.json",
                      "url": ".vscode/settings.json"
              ***REMOVED***
                 ***REMOVED***"filename": ".gitpod.yml",
                      "url": ".gitpod.yml"
              ***REMOVED***
                 ***REMOVED***"filename": ".gitpod.dockerfile",
                      "url": ".gitpod.dockerfile"
              ***REMOVED***
                 ***REMOVED***"filename": ".theia/heroku_config.sh",
                      "url": ".vscode/heroku_config.sh"
              ***REMOVED***
                  ***REMOVED***"filename": ".theia/uptime.sh",
                      "url": ".vscode/uptime.sh"
              ***REMOVED***
                 ***REMOVED***"filename": ".theia/init_tasks.sh",
                      "url": ".vscode/init_tasks.sh"
                  ***REMOVED******REMOVED***

UPGRADE_FILE_LIST = [{"filename": ".vscode/client.cnf",
                      "url": ".vscode/client.cnf"
              ***REMOVED***
                 ***REMOVED***"filename": ".vscode/mysql.cnf",
                      "url": ".vscode/mysql.cnf"
              ***REMOVED***
                 ***REMOVED***"filename": ".vscode/settings.json",
                      "url": ".vscode/settings.json"
              ***REMOVED***
                 ***REMOVED***"filename": ".vscode/launch.json",
                      "url": ".vscode/launch.json"
              ***REMOVED***
                 ***REMOVED***"filename": ".gitpod.yml",
                      "url": ".gitpod.yml"
              ***REMOVED***
                 ***REMOVED***"filename": ".gitpod.dockerfile",
                      "url": ".gitpod.dockerfile"
              ***REMOVED***
                 ***REMOVED***"filename": ".vscode/heroku_config.sh",
                      "url": ".vscode/heroku_config.sh"
              ***REMOVED***
                 ***REMOVED***"filename": ".vscode/init_tasks.sh",
                      "url": ".vscode/init_tasks.sh"
              ***REMOVED***
                 ***REMOVED***"filename": ".vscode/uptime.sh",
                      "url": ".vscode/uptime.sh"
              ***REMOVED***
                 ***REMOVED***"filename": ".vscode/make_url.py",
                      "url": ".vscode/make_url.py"
             ***REMOVED***
                 ***REMOVED***"filename": ".vscode/arctictern.py",
                      "url": ".vscode/arctictern.py"
                  ***REMOVED******REMOVED***

FINAL_LINES = "\nexport POST_UPGRADE_RUN=1\nsource ~/.bashrc\n"


def needs_upgrade():
    ***REMOVED***
    Checks the version of the current template against
    this version.
    Returns True if upgrade is needed, False if not.
    ***REMOVED***

    if exists(".vscode/version.txt"):
        with open(".vscode/version.txt", "r") as f:
            THIS_VERSION = float(f.read().strip())
    ***REMOVED***
        THIS_VERSION = 1.0
        with open(".vscode/version.txt", "w") as f:
            f.write(str(THIS_VERSION))
    
    r = requests.get(BASE_URL + ".vscode/version.txt")
    CURRENT_VERSION = float(r.content)
    print(f"Upstream version: {CURRENT_VERSION}")
    print(f"Local version: {THIS_VERSION}")

    return CURRENT_VERSION > THIS_VERSION


def build_post_upgrade():

    r = requests.get(BASE_URL + ".vscode/upgrades.json")
    upgrades = json.loads(r.content.decode("utf-8"))
    content = ""

    for k,v in upgrades.items():
        if float(k) > THIS_VERSION:
            print(f"Adding version changes for {k} to post_upgrade.sh")
            content += v

    if content:
        content += FINAL_LINES
        with open(".vscode/post_upgrade.sh", "w") as f:
            f.writelines(content)
    
    print("Built post_upgrade.sh. Restart your workspace for it to take effect")


def process(file, suffix):
    ***REMOVED***
    Replaces and optionally backs up the files that
    need to be changed.
    Arguments: file - a path and filename
               suffix - the suffix to the BASE_URL
    ***REMOVED***

    if BACKUP:
        try:
            shutil.copyfile(file, f"{file}.bak")
        except FileNotFoundError:
            print(f"{file} not found, a new one will be created")

    with open(file, "wb") as f:
        r = requests.get(BASE_URL + suffix)
        f.write(r.content)


def start_migration():
    ***REMOVED***
    Calls the process function and
    renames the directory
    ***REMOVED***
    if not os.path.isdir(".theia") and MIGRATE:
        sys.exit("The .theia directory does not exist")

    FILE_LIST = MIGRATE_FILE_LIST if MIGRATE else UPGRADE_FILE_LIST

    if not MIGRATE and not os.path.isdir(".vscode"):
        print("Creating .vscode directory")
        os.mkdir(".vscode")

    for file in FILE_LIST:
        print(f"Processing: {file['filename'***REMOVED***}")
        process(file["filename"***REMOVED***, file["url"***REMOVED***)

    if MIGRATE and os.path.isdir(".vscode"):
        print(".vscode directory already exists")
        if input("Overwrite? Y/N ").lower() == "y":
            shutil.rmtree(".vscode")
        ***REMOVED***
            print("You will need to manually remove the .theia directory after migration.")

    if MIGRATE and not os.path.isdir(".vscode"):
        print("Renaming directory")
        os.rename(".theia", ".vscode")
    
    if not MIGRATE and needs_upgrade():
        build_post_upgrade()

    print("Changes saved.")
    print("Please add, commit and push to GitHub.")
    print("You may need to stop and restart your workspace for")
    print("the changes to take effect.")


if __name__ == "__main__":

    BACKUP = "--nobackup" not in sys.argv
    MIGRATE = "--migrate" in sys.argv

    print("CI Template Migration Utility 0.2")
    print("---------------------------------")
    print("The default action is to upgrade the workspace to the latest version.")
    print(f"Usage: python3 {sys.argv[0***REMOVED***} [--nobackup --migrate***REMOVED***")

    if not BACKUP:
        print("If the --nobackup switch is provided, then changed files will not be backed up.")
    if not MIGRATE:
        print("If the --migrate switch is provided, the repo will be migrated from Theia to VS Code")

    print()

    if input("Start? Y/N ").lower() == "y":
        start_migration()
    ***REMOVED***
        sys.exit("Migration cancelled by the user")

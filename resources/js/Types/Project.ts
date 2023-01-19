export interface Project {
  uuid: string;
  title: string;
  description: string;
  settings: ProjectSettings;
  isOwner: boolean;
}

export interface ProjectWrap {
  data: Project;
}

export interface Projects {
  data: Project[];
}

export interface ProjectSettings {
  from?: string;
  to?: string;
  direction?: string;
  font?: string;
}

export interface ProjectForm {
  title: String;
  description: String;
  settings: ProjectSettings;
}

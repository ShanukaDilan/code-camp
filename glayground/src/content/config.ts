import { defineCollection, z } from 'astro:content';
import { glob } from 'astro/loaders';

const lessons = defineCollection({
  loader: glob({ pattern: "**/*.{md,mdx}", base: "./src/content/lessons" }),
  schema: z.object({
    title: z.string(),
    description: z.string().optional(),
    chapter: z.number().optional(),
    lessonOrder: z.number().optional(),
    isLive: z.boolean().default(true),
  })
});

export const collections = {
  lessons,
};
